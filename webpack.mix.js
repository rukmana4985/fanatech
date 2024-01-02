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

// backend css
mix.styles([
    'resources/assets/vendors/bootstrap/css/bootstrap.min.css',
    'resources/assets/vendors/bootstrap-switch/css/bootstrap-switch.min.css',
    'resources/assets/css/components.css',
    'resources/assets/css/plugins.css',
    'resources/assets/css/custom.css',
    'resources/assets/css/darkblue.css',
    'resources/assets/css/layout.css'
], 'public/css/backend.css');

// backend JS
mix.scripts([
    'resources/assets/js/jquery.min.js',
    'resources/assets/js/excanvas.min.js',
    'resources/assets/js/ie8.min.js',
    'resources/assets/js/respond.min.js',
    'resources/assets/vendors/bootsrap/js/bootsrap.min.js',
    'resources/assets/js/js.cookie.min.js',
    'resources/assets/vendors/jquery-slimscroll/jquery.slimscrol.js',
    'resources/assets/vendors/bootstrap-switch/js/bootstrap-switch.js',
    'resources/assets/js/app.js',
    'resources/assets/js/layout.js',
    'resources/assets/js/demo.js',
    'resources/assets/js/quick-nav.js',
    'resources/assets/js/quick-sidebar.js',
], 'public/js/backend.js');