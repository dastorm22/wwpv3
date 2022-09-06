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
                                <li><a href="{{  action('DataController@downloadOfert') }}">Download Excel</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ action('DataController@downloadLogfile') }}">Logfile</a></li>
                            </ul>
                        </div>
                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="https://www.amazon.com/"  target="_blank">
                                <button type="button" class="btn btn-warning waves-effect waves-light">
                                    Amazon <span class="m-l-5"><i class="fa fa-amazon"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Offers Comparison</h4>
                        <p class="text-muted page-title-alt">
                            Generated on {{ $prueba->created_at->toDayDateTimeString() }}
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
                                    <th>Description</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>WWP</th>
                                    <th>Price Offer</th>
                                    <th>File</th>
                                    <th>Vendor</th>
                                    <th>offer</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                <tr>
                                    <td>{{ $row['product']['upc'] ?? '' }}</td>
                                    <td>{{ $row['product']['name'] ?? '' }}</td>
                                    <td>{{ $row['description'] ?? '' }}</td>  
                                    <td>{{ $row['product']['sku'] ?? '' }}</td>
                                    <td>{{ $row['product']['category'] ?? '' }}</td>
                                    <td>{{ $row['product']['brand'] ?? '' }}</td>
                                    <td>{{ $row['sources'][5]['price'] ?? '' }}</td>
                                    @if($row['sources'][5]['price'] == $row['oferts'])
                                    <td style="color:black;">{{ $row['oferts'] ?? '' }}</td>    
                                    @elseif ($row['sources'][5]['price'] < $row['oferts'])
                                    <td style="background-color:#777a76;color:black;">{{ $row['oferts'] ?? '' }}</td>    
                                    @else
                                    <td style="background-color:#8abbe3;">{{ $row['oferts'] ?? '' }}</td>    
                                    @endif
                                    <td>{{ $row['file'] ?? '' }}</td>     
                                    <td>{{ $row['vendor'] ?? '' }}</td>  
                                    <td>{{ $row['offer'] ?? '' }}</td>        
                                </tr>
                                

                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UPC</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>WWP</th>
                                        <th>Price Offer</th>
                                        <th>File</th>
                                        <th>Vendor</th>
                                        <th>offer</th>
                                    </tr>
                                </tfoot>
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
        OfertList.init();

    });
</script>
@endpush