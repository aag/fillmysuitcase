const mix = require('laravel-mix');

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/controllers.js',
  ], 'public/js/app.js')
  .sass('resources/assets/sass/styles.scss', 'public/css/styles.css')
  .setPublicPath('public/')
  .version();

mix.version([
  'public/img/backpack.jpg',
  'public/img/cross.png',
  'public/img/check.png',
  'public/img/glyphicons-halflings-white.png',
  'public/img/glyphicons-halflings.png'
]);

