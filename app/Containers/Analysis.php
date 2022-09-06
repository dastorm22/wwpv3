<?php

namespace App\Containers;

use App\AnalysisCache;
use App\Console\Commands\AnalysisCommand;
use App\Source;
use App\UPC;
use Illuminate\Console\OutputStyle;

class Analysis
{
    protected $output;

    public function __construct(OutputStyle $output)
    {
        $this->output = $output;
    }

    /**
     * Analyzes the main source against all other sources.
     *
     * Stores the results in the analysis cache.
     */
    public function generateComparisonOld()
    {
        $mainSource = Source::whereIsMain(true)->firstOrFail();
        $allSources = Source::whereIsEnabled(true)->get();

        $rows = $this->getAlignedList($mainSource, $allSources);

        $json = json_encode($rows);

        AnalysisCache::create([
            'type' => AnalysisCache::TYPE_COMPARISON,
            'contents' => $json,
        ]);
    }

    /**
     * Analyzes the main source against all other sources.
     *
     * Stores the results in the analysis cache.
     */
    public function generateComparison()
    {
        $mainSource = Source::whereIsMain(true)->firstOrFail();
        $sources = Source::whereIsEnabled(true)->get();

        $mainProducts = $mainSource->getCurrentProducts();

        $rows = [];

        foreach($mainProducts as $product) {
            $rows[$product->upc]['product'] = $product;

            $rows[$product->upc]['sources'][$mainSource->id] = [
                'price' => $product->price,
                'stock' => $product->stock,
            ];
        }

        foreach ($sources as $source) {
            $products = $source->getCurrentProducts();

            foreach($products as $product) {
                // Prioritize WWP info
                if($source->is_main){
                    $rows[$product->upc]['product'] = $product;
                }

                if($source->is_main || isset($rows[$product->upc])) {
                    $rows[$product->upc]['sources'][$source->id] = [
                        'price' => $product->price,
                        'stock' => $product->stock,
                        'class' => $this->getStyle($rows[$product->upc]['product']->price, $product->price),
                    ];
                }
            }
        }

        $json = json_encode($rows);

        AnalysisCache::create([
            'type' => AnalysisCache::TYPE_COMPARISON,
            'contents' => $json,
        ]);
    }

    /**
     * Analyzes all sources against each other.
     *
     * Stores the results in the analysis cache.
     */
    public function generateCrossReference()
    {
        $sources = Source::whereIsEnabled(true)->get();

        $rows = [];

        foreach ($sources as $source) {
            $products = $source->getCurrentProducts();

            foreach($products as $product) {
                // Prioritize WWP info
                if($source->is_main || !isset($rows[$product->upc]['product'])){
                    $rows[$product->upc]['product'] = $product;
                }

                $rows[$product->upc]['sources'][$source->id] = [
                  'price' => $product->price,
                  'stock' => $product->stock,
              ];
            }
        }

        // remove rows without any prices
        $finalRows = [];

        foreach($rows as $key => $row) {
            $hasPrice = false;

            foreach($row['sources'] as $rowSource) {
                if($rowSource['price']) {
                    $hasPrice = true;
                }
            }

            if($hasPrice) {
                $finalRows[] = $row;
            }
        }

        $json = json_encode($finalRows);

        AnalysisCache::create([
            'type' => AnalysisCache::TYPE_CROSS_REFERENCE,
            'contents' => $json,
        ]);
    }

    /**
     * Returns an array of an array of products with the upc as the key.
     * The outer array has the source id as the key.
     * i.e. $allProducts[source_id][upc].
     *
     * @param $sources
     * @return array
     */
    protected function getProductsFromSources($sources)
    {
        $allProducts = [];

        foreach ($sources as $source) {
            $products = $source->getCurrentProducts();

            if ($products) {
                $allProducts[$source->id] = $source->getCurrentProducts()->keyBy('upc');
            }
        }

        return $allProducts;
    }

    /**
     * Returns an array of products grouped by upc.
     * Matches only products in the main source.
     *
     * @param Source $mainSource
     * @param Source[] $allSources
     * @return array
     */
    protected function getAlignedList($mainSource, $allSources)
    {
        $mainProducts = $mainSource->getCurrentProducts();
        $allProducts = $this->getProductsFromSources($allSources);

        $bar = $this->output->createProgressBar(count($mainProducts));

        $rows = [];

        foreach ($mainProducts as $mainProduct) {
            $productRow = [
                'product' => $mainProduct,
            ];

            foreach ($allSources as $source) {
                $product = $allProducts[$source->id][$mainProduct->upc] ?? null;

                if ($product) {
                    $productData = [
                        'id' => $product->id,
                        'price' => $product->price,
                        'stock' => $product->stock,
                        'class' => $this->getStyle($mainProduct->price, $product->price),
                    ];
                } else {
                    $productData = [];
                }

                $productRow['group'][$source->id] = $productData;
            }

            $rows[] = $productRow;

            $bar->advance();
        }

        $bar->finish();
        $this->output->writeln(' Success');

        return $rows;
    }

    /**
     * Returns the CSS style for the cell based on the price difference.
     *
     * @param $priceA
     * @param $priceB
     * @return string
     */
    protected function getStyle($priceA, $priceB)
    {
        $class = '';

        if ($priceA > $priceB) {
            $class = 'text-danger';
        } elseif ($priceA < $priceB) {
            $class = 'text-success';
        }

        return $class;
    }
}
