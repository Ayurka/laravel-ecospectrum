<?php

require __DIR__.'/backend/login.php';

Route::group(['as' => 'frontend.'], function () {
    require __DIR__.'/frontend/route.php';
});

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    require __DIR__.'/backend/route.php';
});
