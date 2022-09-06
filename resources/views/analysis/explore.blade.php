@extends('layouts.layout')

@section('title', 'Explore Prices')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}"> {{-- Select2 Multi Select --}}
@endpush

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <form action="{{ action('AnalysisController@exploration') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}

                <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group pull-right m-t-15 m-r-5">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Start <span class="m-l-5"><i class="fa fa-check"></i></span>
                                </button>
                            </div>

                            <h4 class="page-title">New Exploration</h4>
                            <p class="text-muted page-title-alt">Upload a file to explore pricing against all vendors.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            @component('partials.components.card-box')
                                @slot('title', 'Exploration Source')

                                <div class="row m-t-40">
                                    <div class="col-md-12">
                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'File')
                                            @include('partials.forms.file',[
                                                'name' => 'file',
                                                'required' => true,
                                            ])
                                        @endcomponent

                                        <hr>

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Main Source Only')
                                            @include('partials.forms.switch', [
                                                'name'=>'is_only_main',
                                                'label' => 'Only compare against the main source.'
                                            ])
                                        @endcomponent
                                    </div>
                                </div>
                            @endcomponent
                        </div>

                        <div class="col-sm-6">
                            @component('partials.components.card-box')
                                @slot('title', 'File Settings')

                                <div class="row m-t-40">
                                    <div class="col-md-12">
                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Rows to Skip')
                                            @include('partials.forms.input',[
                                                'name' => 'skip_rows',
                                                'value' => $source->skip_rows ?? 0,
                                                'required' => true,
                                            ])
                                        @endcomponent

                                        <hr>

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'UPC')
                                            @include('partials.forms.select-array', [
                                                'name' => 'column_upc',
                                                'options' => $columns,
                                                'selected' => $source->column_upc,
                                                'required' => true,
                                                ])
                                        @endcomponent

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Name')
                                            @include('partials.forms.select-array', [
                                                'name' => 'column_name',
                                                'options' => $columns,
                                                'selected' => $source->column_name,
                                                'required' => true,
                                                ])
                                        @endcomponent

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Price')
                                            @include('partials.forms.select-array', [
                                                'name' => 'column_price',
                                                'options' => $columns,
                                                'selected' => $source->column_price,
                                                'required' => true,
                                                ])
                                        @endcomponent

                                        <hr>

                                        @component('partials.components.form-group-horizontal')
                                            @slot('label', 'Stock')
                                            @include('partials.forms.select-array', [
                                                'name' => 'column_stock',
                                                'options' => $columns,
                                                'selected' => $source->column_stock,
                                                ])
                                        @endcomponent

                                    </div>
                                </div>
                            @endcomponent
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- container -->
    </div><!-- content -->

@stop

@push('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script> {{-- Form Validation --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script> {{-- Select 2 Multi Select --}}

<script>
    $(document).ready(function() {
        // Select2
        $(".select2").select2();

        // Form Validation (must go after select2)
        $('form').parsley();
    });

</script>
@endpush