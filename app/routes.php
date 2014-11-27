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

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::get('login', ['uses' => 'HomeController@loginScreen', 'as' => 'login_url']);
Route::post('login', ['uses' => 'HomeController@login']);
Route::get('logout', ['uses' => 'HomeController@logout']);

Route::group(['before' => 'auth'], function(){
    Route::resource('users', 'UserController');
    Route::resource('topics', 'TopicController');
    Route::resource('events', 'EventController');
    Route::resource('categories', 'CategoryController');
    Route::resource('veneus', 'VenueController');

    Route::get('json/get-data/{model}/{id?}', ['uses' => 'DataController@getJsonResponse']);
});

Route::group(['before' => 'auth|admin'], function(){
    Route::get('admin', ['uses' => 'DashboardController@index', 'as' => 'admin_url']);
});
