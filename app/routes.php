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

Route::get('/account',  array('as' => 'user.edit', 'before' => 'auth', 'uses' => 'UserController@showEditForm'));
Route::post('/account', array('as' => 'user.update', 'before' => array('auth', 'csrf'), 'uses' => 'UserController@storeEdit'));

Route::get('/account/delete',  array('as' => 'user.delete', 'before' => 'auth', 'uses' => 'UserController@showDeleteForm'));
Route::post('/account/delete', array('as' => 'user.dodelete', 'before' => array('auth', 'csrf'), 'uses' => 'UserController@delete'));

Route::get('/passwordreset',      array('as' => 'passwordreset', 'uses' => 'RemindersController@getRemind'));
Route::post('/passwordreset',     array('as' => 'sendpasswordreset', 'before' => 'csrf', 'uses' => 'RemindersController@postRemind'));
Route::get('/password/{token}',   array('as' => 'setpassword', 'uses' => 'RemindersController@getReset'));
Route::post('/password/{token}',  array('as' => 'dosetpassword', 'before' => 'csrf', 'uses' => 'RemindersController@postReset'));

Route::get('/list', array('as' => 'listpage', 'before' => 'auth', 'uses' => 'ItemController@listPage'));
Route::post('/list/unpackall', array('as' => 'unpackall', 'before' => 'auth', 'uses' => 'ItemController@unpackAll'));
Route::resource('item', 'ItemController', array('before' => 'auth', 'except' => array('edit', 'update')));

// The Angular JS $resource service uses POST instead of PUT for updates
Route::post('/item/{id}', array('as' => 'item.update', 'uses' => 'ItemController@update'));

