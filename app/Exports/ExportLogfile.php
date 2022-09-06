<?php

namespace App\Exports;

use App\Ofert;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportLogfile implements FromView
{
    protected $viewData;

    public function __construct($viewData)
    {
        $this->viewData = $viewData;
    }

    public function view(): View
    {
        return view('excels.log', $this->viewData);
    }
}
