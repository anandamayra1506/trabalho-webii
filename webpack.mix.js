const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
       require('autoprefixer'),
   ])
   .setPublicPath('public')
   .sourceMaps()
   .version();


// const mix = require('laravel-mix');
// const path = require('path');

// mix.js('resources/js/app.js', 'public/js')
//    .css('resources/css/app.css', 'public/css')
//    .setPublicPath('public')
//    .sourceMaps()
//    .version();

// mix.styles([
//     'node_modules/bootstrap/dist/css/bootstrap.min.css',
// ], 'public/css/bootstrap.css');

// mix.scripts([
//     'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
// ], 'public/js/bootstrap.js');
