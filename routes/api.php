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



Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' =>'jwt'], function () {
    Route::post('auth/logout', 'AuthController@logout');

	//Routes clients
	Route::get('/clients', 'ClientController@index');
	Route::post('/clients', 'ClientController@store');
	Route::put('/clients', 'ClientController@update');	
	Route::delete('/clients/{id}', 'ClientController@destroy');

	Route::group(['middleware' =>'role'], function () {
		//Routes users
		Route::get('/users', 'UserController@index');
		Route::post('/users', 'UserController@store');
		Route::put('/users', 'UserController@update');	
		Route::get('/users/{data}', 'UserController@search');
		Route::delete('/users/{id}', 'UserController@destroy');
	});
});

	



