<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'root', 'uses' => 'HomeController@showHome'));

Route::get('/login',   array('as' => 'login', 'uses' => 'UserController@showLoginForm'));
Route::post('/login',  array('as' => 'dologin', 'before' => 'csrf', 'uses' => 'UserController@login'));
Route::get('/logout',  array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('/user/create',  array('as' => 'createuser', 'uses' => 'UserController@showCreateForm'));
Route::post('/user',        array('as' => 'storeuser', 'before' => 'csrf', 'uses' => 'UserController@storeNew'));

Route::get('/passwordreset',      array('as' => 'passwordreset', 'uses' => 'UserController@showPasswordResetForm'));
Route::post('/passwordreset',     array('as' => 'sendpasswordreset', 'before' => 'csrf', 'uses' => 'UserController@sendPasswordEmail'));
Route::get('/password/{token}',   array('as' => 'setpassword', 'uses' => 'UserController@showSetPasswordForm'));
Route::post('/password/{token}',  array('as' => 'dosetpassword', 'before' => 'csrf', 'uses' => 'UserController@setPassword'));

Route::get('/list', array('as' => 'listpage', 'before' => 'auth', 'uses' => 'ItemController@listPage'));
Route::resource('item', 'ItemController', array('before' => 'auth', 'except' => array('create', 'edit', 'update')));

// The Angular JS $resource service uses POST instead of PUT for updates
Route::post('/item/{id}', array('as' => 'item.update', 'uses' => 'ItemController@update'));

