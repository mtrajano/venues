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

Route::get('login', ['uses' => 'HomeController@loginScreen', 'as' => 'login_url']);
Route::post('login', ['uses' => 'HomeController@login']);
Route::get('logout', ['uses' => 'HomeController@logout']);

Route::group(['before' => 'auth'], function(){
	Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
	
    Route::resource('json/users', 'UserController');
    Route::resource('json/topics', 'TopicController');
    Route::resource('json/events', 'EventController');
    Route::resource('json/categories', 'CategoryController');
    Route::resource('json/veneus', 'VenueController');
});

Route::group(['before' => 'auth|admin'], function(){
    Route::get('admin', ['uses' => 'DashboardController@index', 'as' => 'admin_url']);
});
