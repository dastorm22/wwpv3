let {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.options({
    processCssUrls: false
});

/**
 * System Styles
 */
mix.less('resources/less/core.less',          'public/css')
    .less('resources/less/components.less',    'public/css')
    .less('resources/less/pages.less',         'public/css');

mix.styles([
    // Base UI
    'public/css/core.css',

    // Plugins
    'public/plugins/switchery/css/switchery.min.css', // Switch Checkboxes
    'public/plugins/select2/css/select2.min.css', // Select 2 Multi Select
    'public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css', // Date Picker
    'public/plugins/bootstrap-daterangepicker/daterangepicker.css', // Date Rage Picker
    'public/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css', // Tags Multi Select
    'public/plugins/sweet-alert2/sweetalert2.min.css', // Sweet Alerts 2

    'public/plugins/datatables/jquery.dataTables.min.css', // DataTables
    'public/plugins/datatables/responsive.bootstrap.min.css', // DataTables Responsive
    'public/plugins/datatables/dataTables.colVis.css', // DataTables Toggle Columns
    'public/plugins/datatables/buttons.dataTables.min.css', // DataTables Toggle Columns


    // Customizations
    'public/css/components.css',
    'public/css/icons.css',
    'public/css/pages.css',
    'public/css/responsive.css',

], 'public/css/bundle.css');

/**
 * System Scripts
 */

mix.scripts([
    // Base UI
    'public/js/jquery.min.js',
    'public/js/bootstrap.min.js',
    'public/js/detect.js',
    'public/js/fastclick.js',
    'public/js/jquery.slimscroll.js',
    'public/js/jquery.blockUI.js',
    'public/js/waves.js',
    'public/js/wow.min.js',
    'public/js/jquery.scrollTo.min.js',

    // Pages and Plugins
    'public/plugins/parsleyjs/parsley.min.js', // Form Validation
    'public/plugins/switchery/js/switchery.min.js', // Switch Checkboxes
    'public/plugins/select2/js/select2.min.js', // Select 2 Multi Select
    'public/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js', // File Upload Button
    // 'public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', // Date Picker
    // 'public/plugins/moment/moment.js', // Moment required by Date Range Picker
    // 'public/plugins/bootstrap-daterangepicker/daterangepicker.js', // Date Range Picker
    // 'public/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js', // Tags Multi Select
    'public/plugins/sweet-alert2/sweetalert2.min.js', // Sweet Alerts 2
    'public/plugins/datatables/jquery.dataTables.min.js', // Datatables
    'public/plugins/datatables/dataTables.bootstrap.js', // Datatables for Bootstrap
    'public/plugins/datatables/dataTables.responsive.min.js', // Datatables responsive
    'public/plugins/datatables/dataTables.colVis.js', // Datatables Toggle Columns
    'public/plugins/datatables/dataTables.buttons.min.js', // Datatables Toggle Columns
    'public/plugins/datatables/jszip.min.js', // Datatables Toggle Columns
    'public/plugins/datatables/pdfmake.min.js', // Datatables Toggle Columns
    'public/plugins/datatables/vfs_fonts.js', // Datatables Toggle Columns
    'public/plugins/datatables/buttons.html5.min.js', // Datatables Toggle Columns
    'public/plugins/datatables/buttons.print.min.js', // Datatables Toggle Columns
    'public/js/handlebars.min.js', // Handleblars

    // UI
    'public/js/jquery.core.js',
    'public/js/jquery.app.js',

    // Application
    'public/js/handlebars.min.js',
    'public/js/wwprobot.js',

], 'public/js/bundle.js');

if (mix.inProduction()) {
    mix.version();
}



