<?php

Route::get('/', ['as'=>'dashboard', 'uses'=>'Backend\Dashboard\DashboardController@dashboard']);
Route::post('/logout', ['as'=>'logout', 'uses'=>'Backend\Auth\LoginController@logout']);
Route::get('/file-manager', function(){
    return view('backend.file_manager');
})->name('file_manager');

require __DIR__.'/page.php';
require __DIR__.'/image.php';
require __DIR__.'/catalog.php';
require __DIR__.'/log.php';
require __DIR__.'/menu.php';
require __DIR__.'/news.php';