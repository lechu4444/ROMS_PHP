const mix = require('laravel-mix');

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

mix
    .js([
        'resources/js/app.js'
    ], 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'resources/vendor/bootstrap-dashboard/js/grasp_mobile_progress_circle-1.0.0.min.js',
        'node_modules/jquery.cookie/jquery.cookie.js',
        'node_modules/jquery-validation/dist/jquery.validate.js',
        'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        'node_modules/datatables/media/js/jquery.dataTables.js',
        'public/vendor/datatables/buttons.server-side.js',
        'resources/js/admin.js'
    ], 'public/js/admin.js')
    .sass('resources/sass/admin.scss', 'public/css')
    .sourceMaps();
// mix
//     .js([
//         'resources/vendor/bootstrap-dashboard/js/grasp_mobile_progress_circle-1.0.0.min.js',
//         'resources/js/admin.js'
//     ], 'public/js/admin.js')
//     .extract([
//         'jquery',
//         'popper',
//         'bootstrap',
//         'jquery.cookie',
//         'jquery-validation',
//         'malihu-custom-scrollbar-plugin'
//     ])
//     .sass('resources/sass/admin.scss', 'public/css');
