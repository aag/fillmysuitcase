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

Route::post('/login',  array('as' => 'dologin', 'before' => 'csrf', 'uses' => 'UserController@doLogin'));
Route::get('/login',   array('as' => 'login', 'uses' => 'UserController@showLogin'));
Route::get('/logout',  array('as' => 'logout', 'uses' => 'UserController@doLogout'));

Route::get('/user/create',  array('as' => 'createuser', 'uses' => 'UserController@create'));
Route::post('/user',        array('as' => 'storeuser', 'before' => 'csrf', 'uses' => 'UserController@store'));



