<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Insert routes for account management (login, account creation, password
// workflow, etc.)
Auth::routes();

// By default the logout URL requires the POST method, but we want to
// be able to use a simple link to do the logout.
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', [
    'as' => 'root',
    'uses' => 'HomeController@showHome'
]);

Route::middleware('auth')->group(function () {
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
});

