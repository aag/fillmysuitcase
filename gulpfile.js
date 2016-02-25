var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('styles.scss');

    mix.scripts([
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        'app.js',
        'controllers.js'
    ]);

    mix.version([
        'css/styles.css',
        'js/all.js',
        'img/backpack.jpg',
        'img/cross.png',
        'img/check.png',
        'img/glyphicons-halflings-white.png',
        'img/glyphicons-halflings.png'
    ]);
});
