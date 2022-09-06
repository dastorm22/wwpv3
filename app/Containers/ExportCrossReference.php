<?php


namespace App\Containers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCrossReference implements FromView
{
    protected $viewData;

    public function __construct($viewData)
    {
        $this->viewData = $viewData;
    }

    public function view(): View
    {
        return view('excels.cross-reference', $this->viewData);
    }
}