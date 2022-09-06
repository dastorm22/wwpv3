<?php

namespace App\Http\Controllers;

use App\Http\Requests\SourceRequest;
use App\Source;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use function test\Mockery\Fixtures\HHVMString;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::withCount('batches')->get();

        return view('sources.index', [
            'sources' => $sources,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sources.create', ['source' => new Source()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SourceRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(SourceRequest $request)
    {
        $source = Source::create($request->all());

        $this->storeFile($request, $source);

        return redirect()->action('SourceController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Source $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('sources.update', ['source' => $source]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SourceRequest $request
     * @param Source $source
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(SourceRequest $request, Source $source)
    {
        $this->storeFile($request, $source);

        $attributes = $this->getAttributes($request);

        $source->update($attributes);

        return redirect()->action('SourceController@index');
    }

    /**
     * Stores an uploaded file.
     *
     * @param Request $request
     * @param Source $source
     * @return string
     * @throws \Exception
     */
    protected function storeFile(Request $request, Source $source)
    {
        /** @var UploadedFile $file */
        $file = $request->file;

        if ($file) {
            if ($file->isValid()) {
                $filename = $source->id . '.' . $file->clientExtension();
                $file->storeAs('imports', $filename);

                $source->file = $filename;
                $source->save();
            } else {
                throw new \Exception('File could not be uploaded.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Source $source
     */
    public function destroy(Source $source)
    {
        $source->delete();
    }

    /**
     * Extracts attributes from the request
     * and makes unset checkboxes null.
     *
     * @param Request $request
     * @return array
     */
    protected function getAttributes(Request $request)
    {
        $checkboxes = [
            'is_main',
            'is_enabled',
            'include_in_explore',
        ];

        $attributes = $request->all();

        // make unchecked checkboxes null (because they are not sent in html)
        foreach ($checkboxes as $checkbox) {
            $attributes[$checkbox] = $request->input($checkbox);
        }

        return $attributes;
    }
}
