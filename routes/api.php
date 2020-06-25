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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('orders/create-payment', 'OrdersController@create');
Route::post('orders/execute-payment', 'OrdersController@execute');

Route::post('subscriptions/create-subscription', 'SubscriptionController@create');
Route::post('subscriptions/execute-payment', 'SubscriptionController@execute');

Route::post('plan/create-payment', 'PlansController@create');
Route::post('plan/execute-payment', 'PlansController@execute');