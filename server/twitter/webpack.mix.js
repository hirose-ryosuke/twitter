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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/tweets/top.js', 'public/js')
    .js('resources/js/tweets/favorite.js', 'public/js')
    .js('resources/js/tweets/users.js', 'public/js')
    .js('resources/js/tweets/follow.js', 'public/js')
    .js('resources/js/tweets/follower.js', 'public/js')
    .sass('resources/scss/main.scss', 'public/css');
