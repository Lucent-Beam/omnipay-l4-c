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
Route::get('payment', 'PaymentController@type_of_payment');

// Route::get('/', 'PaymentController@index');
// Route::get('pay','PaymentController@postPayment');
Route::post('rest','PaymentController@rest');
// Route::get('payform','PaymentController@payform');
