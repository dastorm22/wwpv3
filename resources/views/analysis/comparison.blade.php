@extends('layouts.layout')

@section('title','Comparison')

@section('content')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" >
                                Options <span class="m-l-5"><i class="fa fa-cog"></i></span>
                            </button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="{{  action('AnalysisController@downloadComparison') }}">Download Excel</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ action('AdjustmentController@destroyAll') }}">Clear Adjustments</a></li>
                            </ul>
                        </div>

                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="{{  action('AdjustmentController@download') }}">
                                <button type="button" class="btn btn-primary waves-effect waves-light">
                                    Adjustments <span class="m-l-5"><i class="fa fa-download"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Price Comparison</h4>
                        <p class="text-muted page-title-alt">
                            Generated on {{ $cache->created_at->toDayDateTimeString() }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                        <div class="card-box table-responsive">
                            <div id="spinner" class="text-center"><i class="fa fa-spin fa-cog"></i> Loading List</div>
                            <table id="datatable" class="table table-striped table-bordered" style="display: none;">
                                <thead>
                                <tr>
                                    <th>UPC</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Adjust</th>

                                    @foreach($sources as $source)
                                        <th>{{ $source->name ?? '' }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                <tr>
                                    <td>{{ $row['product']['upc'] ?? '' }}</td>
                                    <td>{{ $row['product']['name'] ?? '' }}</td>
                                    <td>{{ $row['product']['sku'] ?? '' }}</td>
                                    <td>{{ $row['product']['category'] ?? '' }}</td>
                                    <td>{{ $row['product']['brand'] ?? '' }}</td>
                                    <td class="text-center"><input type="text" class="form-control input-price" data-upc="{{ $row['product']['upc'] }}" value="{{ $row['adjustment'] ?? '' }}"></td>

                                    @foreach($sources as $sourceColumn)
                                    <td class="text-center">
                                        @isset($row['sources'][$sourceColumn->id]['price'])
                                            <span class="source-price {{$row['sources'][$sourceColumn->id]['class'] ?? ''}}">{{ $row['sources'][$sourceColumn->id]['price'] ?? '' }}</span>
                                        @endif

                                        @isset($row['sources'][$sourceColumn->id]['stock'])
                                            <br>({{ $row['sources'][$sourceColumn->id]['stock'] ?? '' }})
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End row -->
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $(document).ready(function () {
        ComparisonList.init();
    });
</script>
@endpush