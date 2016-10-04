<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Route::post('/cart/addToCart/{productId}', 'CartController@addToCart')->name('cart.addItem');

Route::post('/cart/removeFromCart/{productId}', 'CartController@removeFromCart')->name('cart.removeItem');

Route::get('/cart', 'CartController@index')->name('cart.allItems');

Auth::routes();

Route::post('/place-order', 'HomeController@store')->name('place.order')->middleware('auth');
