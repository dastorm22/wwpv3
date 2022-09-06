<?php

namespace App\Imports;


use App\Ofert;
use App\Source;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class ImportOfferSources extends StringValueBinder implements ToCollection, WithMultipleSheets, SkipsUnknownSheets
{
    use Importable;

    protected $source;
    protected $output;

    /**
     * ProductImportHandler constructor.
     * @param Source $source
     * @param OutputStyle $output
     */
    public function __construct(Source $source, OutputStyle $output)
    {
        $this->source = $source;
        $this->output = $output;
    }

    public function sheets(): array
    {
        return [
            $this, // handling only the first sheet with this importer
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // skipped $sheetName
    }

    /**
     * Automatically receives a collection of rows from the file.
     *
     * @param Collection $rows
     * @return array
     */
    public function collection(Collection $allRows)
    {
        $rows = $allRows->splice($this->source->skip_rows); // remove header

        $this->output->writeln('Inserting Offer');
        $total = count($rows);
        $bar = $this->output->createProgressBar($total);

        $batch = $this->source->getNewBatch();

        $skipped = 0;

        $rows->each(function ($row) use ($batch, $bar, &$skipped) {
            $upc = $row[$this->source->column_upc];
            $name = $row[$this->source->column_name];
            $price = $row[$this->source->column_price];
            //$file = $this->source->file;
            //dd($description);


            // importing products that have the minimum requirements
            if (is_numeric($upc) && is_numeric($price) && ! empty($name)) {
                $storedUpc = Ofert::firstOrCreate(['upc' => $upc]);

                $storedUpc->offers()->create([
                    'name' => $name,
                    'price' => $price,
                    //'file' => $file,
                    'description' => $row[$this->source->description] ?? null,
                    'brand' => $row[$this->source->column_brand] ?? null,
                    'category' => $row[$this->source->column_category] ?? null,
                    'stock' => $row[$this->source->column_stock] ?? null,
                    'sku' => $row[$this->source->column_sku] ?? null,
                ]);
            } else {
                $skipped++;
//                $this->output->warning(sprintf('Skipped UPC="%s", NAME="%s", PRICE="%s"', $upc, $name, $price));
            }

            $bar->advance();
        });

        $this->output->warning(sprintf('Skipped %s%% of the rows: Check source column settings.', round($skipped / $total * 100)));

        $bar->finish();
        $this->output->writeln(' Success');
        $this->output->writeln('');
    }
}
