<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    // Insert routes for account management (login, account creation, password
    // workflow, etc.)
    Route::auth();

    Route::get('/', [
        'as' => 'root',
        'uses' => 'HomeController@showHome'
    ]);

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/account', [
            'as' => 'account.getedit',
            'uses' => 'AccountController@getEdit'
        ]);

        Route::post('/account/editinfo', [
            'as' => 'account.posteditinfo',
            'uses' => 'AccountController@postEditInfo'
        ]);

        Route::post('/account/changepassword', [
            'as' => 'account.postchangepassword',
            'uses' => 'AccountController@postChangePassword'
        ]);

        Route::get('/account/delete', [
            'as' => 'account.getdelete',
            'uses' => 'AccountController@getDelete'
        ]);

        Route::post('/account/delete', [
            'as' => 'account.postdelete',
            'uses' => 'AccountController@postDelete'
        ]);

        Route::get('/list', [
            'as' => 'listpage',
            'uses' => 'ItemController@listPage'
        ]);

        Route::post('/list/unpackall', [
            'as' => 'unpackall',
            'uses' => 'ItemController@unpackAll'
        ]);

        Route::resource('item', 'ItemController', [
            'except' => ['edit', 'update']
        ]);

        // The Angular JS $resource service uses POST instead of PUT for updates
        Route::post('/item/{id}', [
            'as' => 'item.update',
            'uses' => 'ItemController@update'
        ]);

    });

});

