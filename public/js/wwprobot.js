/**
 * Populates DataTables from AJAX
 *
 * Requires: DataTables, Handlebars,
 */
var ComparisonList = (function () {
    var datatablesOptions = {
        // disabling page size selector
        "pageLength": 50,
        "lengthChange": false,

        // ordering
        "order": [[ 1, "asc" ]],

        // Toggle columns
        "dom": 'C<"clear">lfrtip',
        "colVis": {
            "buttonText": "Columns"
        },

        // Callback after rendering
        "fnDrawCallback": function( oSettings ) {
            Adjustments.rebind(); //called on when redrawn (after pagination too)
            $(window).scrollTop(0); //go to the top after pagination
        },
    }

    function init() {
        $('#datatable').show();
        $('#datatable').dataTable(datatablesOptions);
        $('#spinner').hide();
    }

    // Public Functions
    return {
        init: init,
    }
})();

/**
 * Populates DataTables from AJAX
 *
 * Requires: DataTables, Handlebars,
 */
var CrossReferenceList = (function () {
    var datatablesOptions = {
        "responsive": true,
        // responsively hiding columns

        //"columnDefs": [
            //{ responsivePriority: 1, targets: [1,2] }, // responsive hidden last
            // all other columns are by default priority 10000
            //{ responsivePriority: 10001, targets: [3,4] }, //responsive hidden first
        //],

        "columnDefs": [
            { rresponsivePriority: 1, targets: 0 }, // responsive hidden last
            // all other columns are by default priority 10000
            { responsivePriority: 2, targets: -1 }, //responsive hidden first
        ],

        // disabling page size selector
        "pageLength": 50,
        "lengthChange": false,

        // ordering
        "order": [[ 2, "asc" ]],

        // Toggle columns
        "dom": 'C<"clear">lfrtip',
        "colVis": {
            "buttonText": "Columns"
        },

        // Callback after rendering
        "fnDrawCallback": function( oSettings ) {
            $(window).scrollTop(0); //go to the top after pagination
        },
    };

    function init() {
        $('#datatable').show();
        $('#datatable').dataTable(datatablesOptions);
        $('#spinner').hide();
    }

    // Public Functions
    return {
        init: init,
    }
})();


var ProductsList = (function () {
    var datatablesOptions = {
        "responsive": true,
        // responsively hiding columns

        "columnDefs": [
            { responsivePriority: 1, targets: [1,2] }, // responsive hidden last
            // all other columns are by default priority 10000
            { responsivePriority: 10001, targets: [3,4] }, //responsive hidden first
        ],

        // disabling page size selector
        "pageLength": 50,
        "lengthChange": false,

        // ordering
        "order": [[ 2, "asc" ]],

        // Toggle columns
        "dom": 'C<"clear">lfrtip',
        "colVis": {
            "buttonText": "Columns"
        },

        // Callback after rendering
        "fnDrawCallback": function( oSettings ) {
            $(window).scrollTop(0); //go to the top after pagination
        },
    };

    function init() {
        $('#datatable').show();
        $('#datatable').dataTable(datatablesOptions);
        $('#spinner').hide();
    }

    // Public Functions
    return {
        init: init,
    }
})();

/**
 * Saves price adjustments via Ajax
 *
 * Requires: Swal2
 */
var Adjustments = (function () {
    function init() {
        rebind();
    }

    // sends the price change via ajax for storage
    function store(element) {
        var $element = $(element);
        var price = $element.val();
        var upc = $element.data('upc');

        $.ajax({
            url: '/adjustments',
            type: 'POST',
            data: {
                'upc' : upc,
                'price' : price
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                //
            },
            error: function(data){
                swal('Error!', 'Adjustment could not be saved. Try again later.', 'error');
            }
        });
    }

    // copies the price of a source to the input
    function copyPrice(element) {
        var $element = $(element);
        var $input = $element.closest('tr').find('.input-price');
        var price = $element.html();

        $input.val(price.trim());
        $input.trigger('change');
    }

    // binds events
    function rebind() {
        $('.input-price').change(function(){
            store(this);
        });

        $('.source-price').click(function(){
            copyPrice(this);
        });
    }

    // Public Functions
    return {
        init: init,
        rebind: rebind
    }
})();

/**
 * Deletes a resource by sending a DELETE request to a resource.
 * The clicked element should be '#delete-resource' and have 'data-id=ID'
 *
 * Options:
 *   resourceName: name of the model used on the texts
 *   resourceRoute: relative url of the resource
 *   redirectUrl: url to redirect on success
 *
 * Requires: Swal
 */
var DeleteResource = (function () {
    var resourceName;
    var resourceRoute;
    var redirectUrl;

    function init($options) {
        resourceName = $options.resourceName;
        resourceRoute = $options.resourceRoute;
        redirectUrl = $options.redirectUrl;

        $('#delete-resource').click(destroy);
    }

    // Ajax request to destroy a resource
    function destroy() {
        var id = $(this).data('id');

        swal({
            title: 'Are you sure?',
            text: 'The '+ resourceName +' will be permanently deleted.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete'
        }).then(function () {
            $.ajax({
                url: '/' + resourceRoute + '/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    window.location.replace(redirectUrl);
                },
                error: function(xhr, status, error){
                    var message = 'The '+ resourceName +' could not be deleted. Try again later.';

                    // Displaying custom message, if provided in the response
                    if(xhr.status == 400 && xhr.responseText != '') {
                        message = xhr.responseText;
                    }

                    swal('Error!', message , 'error');
                }
            });
        });

    }

    // Public Functions
    return {
        init: init,
    }
})();


var OfertList = (function () {
    var datatablesOptions = {

		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },


		
		
		
        // disabling page size selector
        lengthMenu: [
            [50, 100, 200, -1],
            [50, 25, 200, 'All'],
        ],

        // ordering
        "order": [[ 1, "asc" ]],

        
        dom: 'Bfrtip',
        buttons: [{ extend: 'pageLength'},{
            extend: 'excelHtml5',
            messageTop: 'If the cell is blue, the price compared to WWP is lower, if the color is gray, the price compared to WWP is higher, if it has no color, the price is the same.',
            customize: function ( xlsx ) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              
              var count = 0;
              var skippedHeader = false;
              $('row c[r^="G"]', sheet).each( function () {
                if (skippedHeader) {
                  var colour = $('tbody tr:eq('+parseInt(count)+') td:eq(6)').css('background-color');
                  if (colour === 'rgb(119, 122, 118)') {
                    $(this).attr( 's', '30' );
                  }
                  else if (colour === 'rgb(138, 187, 227)') {
                    $(this).attr( 's','49' );
                  }
                  count++;
                }
                else {
                  skippedHeader = true;
                }
              });
            }
          }],
        // Callback after rendering
        "fnDrawCallback": function( oSettings ) {
            Adjustments.rebind(); //called on when redrawn (after pagination too)
            $(window).scrollTop(0); //go to the top after pagination
        },
    }

    function init() {
        $('#datatable').show();
        $('#datatable').dataTable(datatablesOptions);
        $('#spinner').hide();
    }

    // Public Functions
    return {
        init: init,
    }
})();

var LogfileList = (function () {
    var datatablesOptions = {

		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        "responsive": true,
        // responsively hiding columns

        "columnDefs": [
            { responsivePriority: 1, targets: [1,2] }, // responsive hidden last
            // all other columns are by default priority 10000
            { responsivePriority: 10001, targets: [3,4] }, //responsive hidden first
        ],

        // disabling page size selector
        "pageLength": 50,
        "lengthChange": false,

        // ordering
        "order": [[ 2, "asc" ]],

        // Toggle columns
        "dom": 'C<"clear">lfrtip',
        "colVis": {
            "buttonText": "Columns"
        },

        // Callback after rendering
        "fnDrawCallback": function( oSettings ) {
            $(window).scrollTop(0); //go to the top after pagination
        },
    };

    function init() {
        $('#datatable').show();
        $('#datatable').dataTable(datatablesOptions);
        $('#spinner').hide();
    }

    // Public Functions
    return {
        init: init,
    }
})();