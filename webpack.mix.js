let mix = require('laravel-mix');

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

mix.sass('resources/themes/inspinia/sass/app.scss', 'public/css')
    .copy('resources/themes/inspinia/vendor/bootstrap/fonts', 'public/fonts')
    .copy('resources/themes/inspinia/vendor/font-awesome/fonts', 'public/fonts')
    .copy('resources/css/green.png', 'public/css')
    .copy('resources/css/green@2x.png', 'public/css')
    .combine([
        'resources/themes/inspinia/vendor/bootstrap/css/bootstrap.css',
        'resources/themes/inspinia/vendor/toastr/toastr.min.css',
        'resources/themes/inspinia/vendor/animate/animate.css',
        'resources/themes/inspinia/vendor/font-awesome/css/font-awesome.css',
        'resources/themes/inspinia/vendor/dataTables/datatables.min.css',
        'resources/themes/inspinia/vendor/sweetalert/sweetalert.css',
        'resources/themes/inspinia/vendor/dualListbox/bootstrap-duallistbox.min.css',
        'resources/themes/inspinia/vendor/touchspin/jquery.bootstrap-touchspin.min.css',
        'resources/themes/inspinia/vendor/datapicker/datepicker3.css',
        'resources/themes/inspinia/vendor/morris/morris-0.4.3.min.css',
        'resources/themes/inspinia/vendor/iCheck/custom.css',
        'resources/themes/inspinia/vendor/select2/select2.min.css',
        'resources/themes/inspinia/vendor/daterangepicker/daterangepicker.css',
        'resources/themes/inspinia/vendor/bootstrap3-editable/css/bootstrap-editable.css',
    ], 'public/css/vendor.css');
    mix.js([
        'resources/themes/inspinia/vendor/bootstrap/js/bootstrap.js',
        'resources/themes/inspinia/vendor/metisMenu/jquery.metisMenu.js',
        'resources/themes/inspinia/vendor/slimscroll/jquery.slimscroll.min.js',
        'resources/themes/inspinia/vendor/dataTables/datatables.min.js',
        'resources/themes/inspinia/vendor/peity/jquery.peity.min.js',
        'resources/themes/inspinia/vendor/pace/pace.min.js',
        'resources/themes/inspinia/vendor/sweetalert/sweetalert.min.js',
        'resources/themes/inspinia/vendor/jsKnob/jquery.knob.js',
        'resources/themes/inspinia/vendor/datapicker/bootstrap-datepicker.js',
        'resources/themes/inspinia/vendor/chartJs/Chart.min.js',
        'resources/themes/inspinia/vendor/parsley/parsley.min.js',
        'resources/themes/inspinia/vendor/iCheck/icheck.min.js',
        'resources/themes/inspinia/vendor/select2/select2.full.min.js',
        'resources/themes/inspinia/vendor/datetime-moment/datetime-moment.js',
        'resources/themes/inspinia/vendor/daterangepicker/moment.js',
        'resources/themes/inspinia/vendor/daterangepicker/daterangepicker.js',
        'resources/themes/inspinia/vendor/bootstrap3-editable/js/bootstrap-editable.js',
        'resources/themes/inspinia/js/app.js',
    ], 'public/js/app.js')
    .js([
        'resources/js/app.js',
        'resources/js/dashboard/DashboardController.js',
        'resources/js/admin/UsersListController.js',
    ], 'public/js/organizer.js')
    .extract(['jquery', 'bootstrap', 'bootstrap-tagsinput', 'lodash', 'chartjs-plugin-annotation',
        'datatables.net', 'datatables.net-bs', 'datatables.net-buttons', 'toastr'])
    .version();