<?php

// Home
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// Page
Route::get('page/{path}', ['as' => 'page', 'uses' => 'Frontend\Page\PageController@index'])->where('path', '[a-zA-Z0-9\-/_]+');

// Catalog
Route::group(['prefix' => '/catalog'], function () {
    Route::get('/', ['as' => 'catalog', 'uses' => 'Frontend\Catalog\CatalogController@index']);
    Route::get('/{path}', ['as' => 'product', 'uses' => 'Frontend\Catalog\ProductController@index'])->where('path', '[a-zA-Z0-9\-/_]+');
});

// Cart
Route::get('cart', ['as' => 'cart', 'uses' => 'Frontend\CartController@index']);
Route::get('cart/add', ['as' => 'cartAdd', 'uses' => 'Frontend\CartController@add']);
Route::get('cart/update', ['as' => 'cartUpdate', 'uses' => 'Frontend\CartController@update']);
Route::get('cart/remove', ['as' => 'cartRemove', 'uses' => 'Frontend\CartController@remove']);

// Authentication Routes...
Route::get('login', 'Frontend\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Frontend\Auth\LoginController@login');
Route::post('logout', 'Frontend\Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Frontend\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Frontend\Auth\RegisterController@register');

// Password Reset Routes...
/*Route::get('password/reset', 'frontend\Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'frontend\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'frontend\Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'frontend\Auth\ResetPasswordController@reset');*/

// Personal cabinet
Route::group(['prefix' => '/cabinet', 'as' => 'cabinet.', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Frontend\Auth\CabinetController@index']);
});
