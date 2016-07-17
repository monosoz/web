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

Route::get('/w', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/', 'PagesController@index');

Route::post('/cart', 'PagesController@cart');

Route::post('/cart/{item}', 'PagesController@item');

Route::get('/checkout', 'AuthPagesController@checkout');

Route::post('/checkout', 'AuthPagesController@checkout');

Route::get('/user/address', 'AuthPagesController@address');

Route::post('/user/address', 'AuthPagesController@address');
