<?php


namespace App\Containers;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Adjustment;

class ExportAdjustments implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Adjustment::select(['upc', 'price']);
    }
}