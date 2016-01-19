<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),

    /*
    |--------------------------------------------------------------------------
    | Load Javascript Libs from CDN
    |--------------------------------------------------------------------------
    |
    | This option determines whether the Javascript libraries will be loaded
    | from a CDN or from the local server. On production we want to load them
    | from the CDN, to take advantage of existing browser caches and for speed.
    | However, we also want to be able to develop from a computer that is
    | offline, so we load them from the local server in development.
    |
    */

    'cdn_js_libs' => env('VIEW_CDN_JS_LIBS', true),

];
