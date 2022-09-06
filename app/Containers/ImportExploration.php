<?php

namespace App\Containers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class ImportExploration extends StringValueBinder implements WithMultipleSheets, SkipsUnknownSheets
{
    use Importable;

    protected $request;

    /**
     * ProductImportHandler constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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

        $finalRows = [];

        $rows->each(function ($row) use (&$finalRows) {
            $upc = $row[$this->request->column_upc];
            $name = $row[$this->request->column_name];
            $price = $row[$this->request->column_price];
            // importing products that have the minimum requirements
            if (is_numeric($upc) && is_numeric($price) && !empty($name)) {
                $finalRows[] = [
                    'upc' => $upc,
                    'name' => $name,
                    'price' => $price,
                    'stock' => $row[$this->request->column_stock] ?? null,
                ];
            }
        });

        return $finalRows;
    }
}
