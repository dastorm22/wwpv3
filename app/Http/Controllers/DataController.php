<?php

namespace App\Http\Controllers;

use App\Adjustment;
use App\AnalysisCache;
use App\Containers\ExportAdjustments;
use App\Containers\ExportComparison;
use App\Exports\ExportOferts;
use App\Exports\ExportLogfile;


use App\Containers\ExportCrossReference;
use App\Containers\ExportExploration;
use App\Containers\ImportExploration;
use App\Jobs\ProcessSources;
use App\Product;
use App\Ofert;

use App\Source;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;




class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $sources = Source::whereIsEnabled(true)->get();

        $prueba = Ofert::latest()->first();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_COMPARISON)->latest()->first();

        $rows = json_decode($cache->contents, true);
        $adjustments = Adjustment::all()->keyBy('upc');
        $ofert = Ofert::all()->keyBy('upc');



        //dd($prueba);

        foreach ($rows as $i => $row) {
            $upc = $row['product']['upc'];
            if ($ofert[$upc] ?? false) {
            $rows[$i]['oferts'] = $ofert[$upc]->price;
            $rows[$i]['file'] = $ofert[$upc]->file;
            $rows[$i]['vendor'] = $ofert[$upc]->vendor;
            $rows[$i]['offer'] = $ofert[$upc]->offer;
            $rows[$i]['description'] = $ofert[$upc]->description;


            }

        }


        //dd($rows);

    

        return view('data.index', [
            'sources' => $sources,
            'ofert' => $ofert,
            'cache' => $cache,
            'rows' => $rows,
            'prueba' => $prueba,

        ]);

        

    }

    public function downloadOfert()
    {
        $prueba = Ofert::latest()->first();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_COMPARISON)->latest()->first();
        $rows = json_decode($cache->contents, true);
        $ofert = Ofert::all()->keyBy('upc');


        foreach ($rows as $i => $row) {
            $upc = $row['product']['upc'];
            if ($ofert[$upc] ?? false) {
            $rows[$i]['oferts'] = $ofert[$upc]->price;
            }

        }

        $filename = sprintf('ofert-%s.xlsx',Carbon::now()->toDateString());

        return Excel::download(new ExportOferts([
            'prueba' => $prueba,
            'rows' => $rows,
            'ofert' => $ofert,
        ]), $filename);
    }
    public function downloadLogfile()
    {
        $prueba = Ofert::latest()->first();
        $ofert = Ofert::all()->keyBy('upc');

        $filename = sprintf('logOfert-%s.xlsx',Carbon::now()->toDateString());

        return Excel::download(new ExportLogfile([
            'ofert' => $ofert,
        ]), $filename);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LogfileOferts()
    {
        $sources = Source::whereIsEnabled(true)->get();

        $prueba = Ofert::latest()->first();
        $cache = AnalysisCache::whereType(AnalysisCache::TYPE_COMPARISON)->latest()->first();

        $rows = json_decode($cache->contents, true);
        $adjustments = Adjustment::all()->keyBy('upc');
        $ofert = Ofert::all();


        //dd($prueba);

        foreach ($rows as $i => $row) {
            $upc = $row['product']['upc'];
            if ($ofert[$upc] ?? false) {
            $rows[$i]['name'] = $ofert[$upc]->name;
            $rows[$i]['price'] = $ofert[$upc]->price;
            $rows[$i]['stock'] = $ofert[$upc]->stock;
            $rows[$i]['upc'] = $ofert[$upc]->upc;
            $rows[$i]['brand'] = $ofert[$upc]->brand;
            $rows[$i]['category'] = $ofert[$upc]->brand;
            $rows[$i]['file'] = $ofert[$upc]->file;
            $rows[$i]['vendor'] = $ofert[$upc]->vendor;
            $rows[$i]['offer'] = $ofert[$upc]->offer;
            $rows[$i]['sku'] = $ofert[$upc]->sku;
            $rows[$i]['description'] = $ofert[$upc]->description;



            }

        }

           //dd($rows);

    

           return view('data.logfile', [
            'sources' => $sources,
            'ofert' => $ofert,
            'cache' => $cache,
            'rows' => $rows,
            'prueba' => $prueba,

        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
