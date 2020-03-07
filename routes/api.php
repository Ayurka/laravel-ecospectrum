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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'cors','namespace' => 'Api'], function () {
    Route::group(['prefix' => '/auth'], function () {
        Route::post('register', ['as' => 'register', 'uses' => 'AuthController@register']);
        Route::post('userRegistrationValidation', ['as' => 'userRegistrationValidation', 'uses' => 'AuthController@userRegistrationValidation']);
        Route::get('getCompanyByInn/{inn}', ['as' => 'companyByInn', 'uses' => 'AuthController@getCompanyByInn']);
        Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::get('user', ['as' => 'user', 'uses' => 'AuthController@user']);
            Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
            //Route::get('refresh', ['as' => 'refresh', 'uses' => 'AuthController@refresh']);
            Route::post('order/store', ['as' => 'order.store', 'uses' => 'OrderController@store']);
            Route::post('edit/account', ['as' => 'edit.account', 'uses' => 'AuthController@editAccount']);
            Route::post('edit/password', ['as' => 'edit.password', 'uses' => 'AuthController@editPassword']);
            Route::post('edit/company', ['as' => 'edit.company', 'uses' => 'AuthController@editCompany']);
            Route::get('orders', ['as' => 'orders', 'uses' => 'OrderController@orders']);
            Route::get('order/{id}', ['as' => 'order', 'uses' => 'OrderController@order']);
        });
    });

    Route::get('products', ['as' => 'products', 'uses' => 'ProductController@index']);
    Route::get('product/{slug}', ['as' => 'product', 'uses' => 'ProductController@show']);
    Route::get('page/{slug}', ['as' => 'page', 'uses' => 'PageController@show']);
});
