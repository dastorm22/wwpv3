<?php

namespace App\Http\Controllers;

use App\Source;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays all batches of a source.
     *
     * @param Source $source
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sourceIndex(Source $source)
    {
        $batches = $source->batches()
            ->withCount('products')
            ->latest()
            ->get();

        return view('batches.index', [
            'source' => $source,
            'batches' => $batches,
        ]);
    }
}
