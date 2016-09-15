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

Route::get('/', 'PagesController@index');

Route::auth();

Route::get('/about', function () { return view('static.about'); });
Route::get('/policy', function () { return view('static.policy'); });
Route::get('/terms', function () { return view('static.terms'); });
Route::get('/contact', function () { return view('static.contact'); });

Route::post('/cart', 'PagesController@cart');
Route::post('/add_custom', 'PagesController@add_custom');

Route::post('/cart/clear', 'PagesController@clearcart');
Route::post('/cart/applycoupon', 'PagesController@applycoupon');
Route::post('/cart/{item}', 'PagesController@item');

if (config('app.open')) {
Route::get('/checkout', 'AuthPagesController@checkout');
Route::patch('/checkout', 'AuthPagesController@selectaddress');
Route::post('/checkout', 'AuthPagesController@cod');
} else {
Route::get('/checkout', 'PagesController@index');
}

Route::get('/user/address', 'AuthPagesController@addresses');
Route::put('/user/address', 'AuthPagesController@address');
Route::post('/user/address', 'AuthPagesController@addaddress');
Route::patch('/user/address', 'AuthPagesController@editaddress');
Route::delete('/user/address', 'AuthPagesController@deleteaddress');


Route::get('/orders', 'AuthPagesController@orders');
Route::get('/account', 'AuthPagesController@account');

Route::get('/feedback', 'AuthPagesController@feedback');
Route::post('/feedback', 'AuthPagesController@addfeedback');
Route::post('/contactus', 'PagesController@addmessage');


Route::get('/orders0CCAC', 'ShopOperator@orders');
Route::post('/orders0CCAC', 'ShopOperator@changestatus');
