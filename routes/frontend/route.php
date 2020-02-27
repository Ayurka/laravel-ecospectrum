<?php

// Home
Route::get('/', function () {
    return view('frontend.home');
})->name('home');
