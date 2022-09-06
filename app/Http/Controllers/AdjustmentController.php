<?php

namespace App\Http\Controllers;

use App\Adjustment;
use App\Containers\ExportAdjustments;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AdjustmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Stores an adjustment (called via AJAX).
     *
     * @param Request $request
     * @throws \Exception
     */
    public function storeAdjustment(Request $request)
    {
        if ($request->price) {
            Adjustment::updateOrCreate(
                ['upc' => $request->upc],
                ['price' => $request->price]
            );
        }
    }

    /**
     * Deletes all adjustments.
     */
    public function destroyAll()
    {
        Adjustment::truncate();

        return redirect()->action('AnalysisController@comparison');
    }

    /**
     * Generates an excel file of the price adjustments.
     */
    public function download()
    {
        $filename = sprintf('adjustments-%s.xlsx', Carbon::now()->toDateString());

        return (new ExportAdjustments())->download($filename);
    }
}
