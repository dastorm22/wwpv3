<?php

namespace App\Http\Controllers;

use App\Adjustment;
use App\AnalysisCache;
use App\Containers\ExportAdjustments;
use App\Containers\ExportComparison;
use App\Containers\ExportCrossReference;
use App\Containers\ExportExploration;
use App\Containers\ImportExploration;
use App\Containers\ImportProducts;

use App\Imports\ImportOferts;
use App\Jobs\ProcessSources;
use App\Product;
use App\Source;
use App\Ofert;
use App\UPC;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

class AnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Manually triggers the process command.
     */
    public function process()
    {
        dispatch(new ProcessSources());

        return view('analysis.queue-processing');
    }

    /**
     * Displays a table comparing WWP against other vendors.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comparison()
    {
        $sources = Source::whereIsEnabled(true)->get();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_COMPARISON)->latest()->first();
        $rows = json_decode($cache->contents, true);
        $adjustments = Adjustment::all()->keyBy('upc');

        foreach ($rows as $i => $row) {
            $upc = $row['product']['upc'];

            if ($adjustments[$upc] ?? false) {
                $rows[$i]['adjustment'] = $adjustments[$upc]->price;
            }
        }

        return view('analysis.comparison', [
            'sources' => $sources,
            'cache' => $cache,
            'rows' => $rows,
        ]);
    }

    /**
     * Displays a table comparing all vendors vs all vendors.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function crossReference()
    {
        $sources = Source::whereIsEnabled(true)->get();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_CROSS_REFERENCE)->latest()->first();
        $rows = json_decode($cache->contents, true);

        foreach ($rows as $i => $row) {
          
           $rows[$i]['amazon'] = 'https://www.amazon.com/s?k=' . $row['product']['upc'] . '';
        }

        //dd($test);

        return view('analysis.cross-reference', [
            'sources' => $sources,
            'cache' => $cache,
            'rows' => $rows,

        ]);
    }

    /**
     * Displays form to upload a file for price exploration.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function explore()
    {
        return view('analysis.explore', ['source' => new Source()]);
    }

    /**
     * Displays a table comparing an uploaded file vs all vendors.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function exploration(Request $request)
    {
        /** @var UploadedFile $file */
        $file = $request->file;

        if ($file) {
            if ($file->isValid()) {
                $import = new ImportExploration($request);
                $allRows = Excel::toCollection($import, $file);
                $fileRows = $import->parse($allRows->first());

                $sources = Source::whereIsEnabled(true)->whereIncludeInExplore(true)->get();
                $cache = AnalysisCache::whereType(AnalysisCache::TYPE_CROSS_REFERENCE)->latest()->first();
                $referenceRows = json_decode($cache->contents, true);

                $rows = [];

                foreach($fileRows as $fileRow) {
                    $row = [];
                    $row['fileProduct']['upc'] = $fileRow['upc'];
                    $row['fileProduct']['name'] = $fileRow['name'];
                    $row['fileProduct']['price'] = $fileRow['price'];
                    $row['fileProduct']['stock'] = $fileRow['stock'];

                    foreach ($referenceRows as $referenceRow) {
                       if($referenceRow['product']['upc'] == $fileRow['upc']) {
                           $row['sources'] = $referenceRow['sources'];
                           $row['product'] = $referenceRow['product'];
                       }
                    }

                    $rows[] = $row;
                }

                $filename = sprintf('exploration-%s.xlsx',Carbon::now()->toDateTimeString());
                return Excel::download(new ExportExploration([
                    'sources' => $sources,
                    'rows' => $rows,
                    'isOnlyMain' => $request->is_only_main ?? false,
                ]), $filename);
            } else {
                throw new \Exception('File could not be uploaded.');
            }
        }
    }

    /**
     * Downloads an excel file with the latest comparison.
     */
    public function downloadComparison()
    {
        $sources = Source::whereIsEnabled(true)->get();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_COMPARISON)->latest()->first();
        $rows = json_decode($cache->contents, true);

        $filename = sprintf('comparison-%s.xlsx',Carbon::now()->toDateString());

        return Excel::download(new ExportComparison([
            'sources' => $sources,
            'rows' => $rows,
        ]), $filename);
    }

    /**
     * Downloads an excel file with the latest cross reference.
     */
    public function downloadCrossReference()
    {
        $sources = Source::whereIsEnabled(true)->get();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_CROSS_REFERENCE)->latest()->first();
        $rows = json_decode($cache->contents, true);

        $filename = sprintf('cross-reference-%s.xlsx',Carbon::now()->toDateString());

        return Excel::download(new ExportCrossReference([
            'sources' => $sources,
            'rows' => $rows,
        ]), $filename);
    }
    public function ofert()
    {
        return view('analysis.ofert', ['source' => new Source()]);
    }
    public function ofert_upload(Request $request)
    {
        /** @var UploadedFile $file */
        $file = $request->file;
        $namefile =$file->getClientOriginalName();

        //dd($request);


        if ($file) {
            if ($file->isValid()) {
                $import = new ImportOferts($request, $namefile);
                $allRows = Excel::toCollection($import, $file);
                $fileRows = $import->parse($allRows->first());

               
            } else {
                throw new \Exception('File could not be uploaded.');
            }
        }

        return view('analysis.ofert-processing');
       
    }
}
