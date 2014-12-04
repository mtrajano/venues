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

Route::get('json/friendsfinder', ['uses' => 'FriendsFinderController@search']);
Route::get('json/eventsfinder', ['uses' => 'EventsFinderController@search']);

Route::group(['before' => 'auth'], function(){
    Route::resource('users', 'UserController');
    Route::resource('artists', 'ArtistController');
    Route::get('top-artists', 'ArtistController@top');
    Route::resource('events', 'ShowController');
    Route::resource('genres', 'GenreController');
    Route::resource('veneus', 'VenueController');

    Route::get('get-data/json/{model}/{id?}', ['uses' => 'DataController@getJsonResponse']);
    Route::get('get-data/xml/{model}/{id?}', ['uses' => 'DataController@getXMLResponse']);
});

Route::group(['before' => 'auth|admin'], function(){
    Route::get('admin', ['uses' => 'AdminDashboardController@index', 'as' => 'admin_url']);
    Route::get('admin/data', ['uses' => 'AdminDataController@index']);
});
