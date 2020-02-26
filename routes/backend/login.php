<?php

// Authentication Routes...
//Route::get('login', 'Frontend\Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Frontend\Auth\LoginController@login');
//Route::post('logout', 'Frontend\Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Frontend\Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Frontend\Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'frontend\Auth\ForgotPasswordController@showLinkRequestForm');
//Route::post('password/email', 'frontend\Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('password/reset/{token}', 'frontend\Auth\ResetPasswordController@showResetForm');
//Route::post('password/reset', 'frontend\Auth\ResetPasswordController@reset');
//Route::get('/admin/register', ['as'=>'admin.register', 'uses'=>'Backend\Auth\RegisterController@showAdminRegisterForm']);
//Route::post('/admin/create-admin', ['as'=>'admin.createAdmin', 'uses'=>'Backend\Auth\RegisterController@createAdmin']);

Route::get('admin/login', ['as'=>'admin.login', 'uses'=>'Backend\Auth\LoginController@showAdminLoginForm']);
Route::post('admin/admin-login', ['as'=>'admin.adminLogin', 'uses'=>'Backend\Auth\LoginController@adminLogin']);