@extends('layouts.layout')

@section('title','Cross Reference')

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
                                <li><a href="{{  action('AnalysisController@downloadCrossReference') }}">Download Excel</a></li>
                            </ul>
                        </div>
                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="https://www.amazon.com/"  target="_blank">
                                <button type="button" class="btn btn-warning waves-effect waves-light">
                                    Amazon <span class="m-l-5"><i class="fa fa-amazon"></i></span>
                                </button>
                            </a>
                        </div>
                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="{{  action('DataController@LogfileOferts') }}"  target="_blank">
                                <button type="button" class="btn btn-primary waves-effect waves-light">
                                    Log File <span class="m-l-5"><i class="fa fa-file"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Price Cross Reference</h4>
                        <p class="text-muted page-title-alt">
                            Generated on {{ $cache->created_at->toDayDateTimeString() }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                        <div class="card-box table-responsive">
                            <div id="spinner" class="text-center"><i class="fa fa-spin fa-cog"></i> Loading List</div>
                            <table id="datatable" class="table table-striped table-bordered"  style="display: none;">

                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Amazon</th>
                                    <th>UPC</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>

                                    @foreach($sources as $source)
                                        <th>{{ $source->name ?? '' }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                <tr>

                                    
                                    <td></td>
                                    <td><a href="{{ $row['amazon'] ?? '' }}" class="btn btn-link" target="_blank"><i class="fa fa-amazon"></i></a></td>    
                                    <td>{{ $row['product']['upc'] ?? '' }}</td>
                                    <td>{{ $row['product']['name'] ?? '' }}</td>
                                    <td>{{ $row['product']['category'] ?? '' }}</td>
                                    <td>{{ $row['product']['brand'] ?? '' }}</td>

                                    @foreach($sources as $sourceColumn)
                                    <td class="source-price">
                                        @isset($row['sources'][$sourceColumn->id]['price'])
                                            {{ $row['sources'][$sourceColumn->id]['price'] ?? '' }}
                                        @endif

                                        @isset($row['sources'][$sourceColumn->id]['stock'])
                                            ({{ $row['sources'][$sourceColumn->id]['stock'] ?? '' }})
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
        CrossReferenceList.init();
    });
</script>
@endpush
