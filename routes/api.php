<?php

Route::group(['middleware' => 'cors','namespace' => 'Api'], function () {
    Route::group(['prefix' => '/auth'], function () {
        Route::post('register', ['as' => 'register', 'uses' => 'AuthController@register']);
        Route::post(' ', ['as' => 'userRegistrationValidation', 'uses' => 'AuthController@userRegistrationValidation']);
        Route::get('getCompanyByInn', ['as' => 'companyByInn', 'uses' => 'AuthController@getCompanyByInn']);
        Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::get('user', ['as' => 'user', 'uses' => 'AuthController@user']);
            Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
            //Route::get('refresh', ['as' => 'refresh', 'uses' => 'AuthController@refresh']);
            Route::post('edit/account', ['as' => 'edit.account', 'uses' => 'AuthController@editAccount']);
            Route::post('edit/password', ['as' => 'edit.password', 'uses' => 'AuthController@editPassword']);
            Route::post('edit/company', ['as' => 'edit.company', 'uses' => 'AuthController@editCompany']);
            Route::get('orders', ['as' => 'orders', 'uses' => 'OrderController@orders']);
            Route::get('order/{id}', ['as' => 'order', 'uses' => 'OrderController@order']);
            Route::post('order/store-auth', ['as' => 'order.store.auth', 'uses' => 'OrderController@storeAuth']);
        });
        Route::post('order/store-guest', ['as' => 'order.store.guest', 'uses' => 'OrderController@storeGuest']);
    });
    Route::get('isUrl/{path}', ['as' => 'catalog', 'uses' => 'CatalogController@isUrl'])->where('path', '[a-zA-Z0-9\-/_]+');
    Route::get('catalog/{path}', ['as' => 'catalog', 'uses' => 'CatalogController@index'])->where('path', '[a-zA-Z0-9\-/_]+');
    Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController@index']);
    Route::get('category/{slug}', ['as' => 'category', 'uses' => 'CategoryController@show']);
    Route::get('products', ['as' => 'products', 'uses' => 'ProductController@index']);
    Route::get('product/{slug}', ['as' => 'product', 'uses' => 'ProductController@show']);
    Route::get('page/{slug}', ['as' => 'page', 'uses' => 'PageController@show']);
    Route::get('search', ['as' => 'search', 'uses' => 'SearchProductsController@search']);
});
