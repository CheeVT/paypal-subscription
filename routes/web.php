<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscription', function() {
    return view('subscription');
});

Route::get('/plan', function() {
    return view('plan');
});

Route::get('/cancel', function() {
    return view('cancel');
});

Route::get('/success', function() {
    return view('success');
});

Route::post('/subscribe', 'SubscriptionController@subscribe');