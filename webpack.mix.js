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
.sass('resources/sass/app.scss', 'public/css');

// browserSync - Need to run the following commands in root folder
// npm install
// npm update
// npm run watch
try {
    mix.browserSync('localhost:8000');
 }catch(err) {}

