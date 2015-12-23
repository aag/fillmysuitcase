<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', [
    'as' => 'root',
    'uses' => 'HomeController@showHome'
]);

Route::get('/account', [
    'as' => 'account.getedit',
    'middleware' => 'auth',
    'uses' => 'AccountController@getEdit'
]);

Route::post('/account/editinfo', [
    'as' => 'account.posteditinfo',
    'middleware' => 'auth',
    'uses' => 'AccountController@postEditInfo'
]);

Route::post('/account/changepassword', [
    'as' => 'account.postchangepassword',
    'middleware' => 'auth',
    'uses' => 'AccountController@postChangePassword'
]);

Route::get('/account/delete', [
    'as' => 'account.getdelete',
    'middleware' => 'auth',
    'uses' => 'AccountController@getDelete'
]);

Route::post('/account/delete', [
    'as' => 'account.postdelete',
    'middleware' => 'auth',
    'uses' => 'AccountController@postDelete'
]);

Route::get('/list', [
    'as' => 'listpage',
    'middleware' => 'auth',
    'uses' => 'ItemController@listPage'
]);

Route::post('/list/unpackall', [
    'as' => 'unpackall',
    'middleware' => 'auth',
    'uses' => 'ItemController@unpackAll'
]);

Route::resource('item', 'ItemController', [
    'middleware' => 'auth',
    'except' => ['edit', 'update']
]);

// The Angular JS $resource service uses POST instead of PUT for updates
Route::post('/item/{id}', [
    'as' => 'item.update',
    'uses' => 'ItemController@update'
]);


