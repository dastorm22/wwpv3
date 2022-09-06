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
                        <div class="btn-group pull-right m-t-15 m-r-5">
                            <a href="{{ action('DataController@downloadLogfile') }}"  target="_blank">
                                <button type="button" class="btn btn-warning waves-effect waves-light">
                                    Logfile <span class="m-l-5"><i class="fa fa-file"></i></span>
                                </button>
                            </a>
                        </div>

                        <h4 class="page-title">Log File Offers</h4>
                        <p class="text-muted page-title-alt">
                            Generated on {{ $prueba->created_at->toDayDateTimeString() }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                        <div class="card-box table-responsive">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>Load Date</th>
                                        <th>UPC</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                        <th>Offer</th>
                                        <th>File</th>
                                        <th>Brand</th>
                                        <th>Sku</th>
                                        <th>Category</th>

                                    </tr>
                                    </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Load Date</th>
                                        <th>UPC</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                        <th>Offer</th>
                                        <th>File</th>
                                        <th>Brand</th>
                                        <th>Sku</th>
                                        <th>Category</th>
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
<script type="text/javascript">
    $(function () {
        $('.yajra-datatable thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('.yajra-datatable thead');
      
      var table = $('.yajra-datatable').DataTable({

        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        lengthMenu: [
            [50, 100, 200, -1],
            [50, 25, 200, 'All'],
        ],
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 50,
        dom: 'C<"clear">lfrtip',
        columnDefs: [ 
        { "width": "10%", "targets": 0 },
        { "width": "10%", "targets": 1},
        { "width": "10%", "targets": 2 },
        { "width": "10%", "targets": 3 },
        { "width": "50%", "targets": 4 },
        { "width": "10%", "targets": 5 },
        { "width": "10%", "targets": 6 },
        { "width": "10%", "targets": 7 },
        {"visible": true, "targets": [0,1,2,3,4,5,6,7,8]},
        {"visible": false, "targets": '_all'},
        ],
         
        order: [[2, 'desc']],
        ajax: "{{ route('offer.index') }}",
        columns: [
            {
               data: 'created_at',
               type: 'num',
               render: {
                  _: 'display',
                  sort: 'timestamp'
               }
            },
        {data: 'upc', name: 'upc'},
        {data: 'name', name: 'name'},
        {data: 'description', name: 'description'},
        {data: 'stock', name: 'stock'},
        {data: 'price', name: 'price'},
        {data: 'vendor', name: 'vendor'},
        {data: 'offer', name: 'offer'},
        {data: 'file', name: 'file'},
        {data: 'brand', name: 'brand'},
        {data: 'sku', name: 'sku'},
        {data: 'category', name: 'category'},

             


          ]
      });
      
      
    });
</script>
@endpush