<?php

Route::post('image/delete/{id}', function ($id){
    return App\Services\Facades\MyImage::deleteImage($id);
})->name('image_delete');

Route::post('image/sort', function (){
    return App\Services\Facades\MyImage::sortImage();
})->name('image_sort');