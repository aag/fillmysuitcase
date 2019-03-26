<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->group(function () {
    Route::post('/list/unpackall', [
        'as' => 'unpackall',
        'uses' => 'ItemController@unpackAll'
    ]);

    Route::apiResource('items', 'ItemController');

    // The Angular JS $resource service uses POST instead of PUT for updates
    Route::post('/items/{id}', [
        'as' => 'items.update',
        'uses' => 'ItemController@update'
    ]);
});

