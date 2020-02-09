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


//auth routes
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('open', 'DataController@open');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/products/insert-product', 'ProductsController@insertProduct');
        Route::post('/order/set-order', 'OrderController@setOrder');
        Route::post('/payment/online-payment/{order}', 'PaymentController@onlinePayment');
    });

//Route::post('/products/insert-product', 'ProductsController@insertProduct');
//Route::post('/order/set-order', 'OrderController@setOrder');


