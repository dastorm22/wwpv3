<?php

namespace App\Imports;

use App\Ofert;
use App\UPC;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class ImportOferts extends StringValueBinder implements WithMultipleSheets, SkipsUnknownSheets
{
    use Importable;

    protected $request;
    protected $namefile;


    /**
     * ProductImportHandler constructor.
     * @param Request $request
     */
    public function __construct(Request $request, $namefile )
    {
        $this->request = $request;
        $this->namefile = $namefile;


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

    public function parse($allRows)
    {
        $rows = $allRows->splice($this->request->skip_rows); // remove header

        $namefile = ($this->namefile); // remove header



        $finalRows = [];
        $rows->each(function ($row) use (&$finalRows) {
            $upc = $row[$this->request->column_upc];
            $name = $row[$this->request->column_name];
            $price = $row[$this->request->column_price];
            $stock = $row[$this->request->column_stock];
            $description = $row[$this->request->column_description];
            $vendor = $this->request->vendor;
            $offer = $this->request->offer;
            //dd($request);


            $file = ($this->namefile);

            //dd($description);


            // importing products that have the minimum requirements
            if (is_numeric($upc) && is_numeric($price) && !empty($name) && !empty($description)) {
                $finalRows[] = [
                    'upc' => $upc,
                    'name' => $name,
                    'stock' => $stock,
                    'price' => $price,
                    'description' => $description,
                    'file' => $file,
                    'vendor' => $vendor,
                    'offer' => $offer,
                    
                ];
              
                /*$storedUpc = Ofert::updateOrCreate(['upc' => $upc],
                ['name' => $name, 'price' => $price, 'stock' => $stock, 'file' => $file, 'vendor' => $vendor,  'offer' => $offer]
                );

                $storedUpc->oferts()->create([
                    'name' => $name,
                    'price' => $price,
                ]);*/

                $ofert = Ofert::create([
                    'upc' => $upc,
                    'name' => $name,
                    'stock' => $stock,
                    'price' => $price,
                    'description' => $description,
                    'file' => $file, 
                    'vendor' => $vendor,
                    'offer' => $offer
                    
                ]);


            }
        });

        return $finalRows;
    }

}
