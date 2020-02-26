<?php

Route::resource('product', 'Backend\Catalog\ProductController');
Route::resource('category', 'Backend\Catalog\CategoryController');
Route::post('category/sort', ['as' => 'category.sort', 'uses' => 'Backend\Catalog\CategoryController@sort']);
Route::resource('attribute', 'Backend\Catalog\AttributeController');
Route::get('attributeDelete', ['as' => 'attributeDelete', 'uses' => 'Backend\Catalog\AttributeDeleteController@__invoke']);
Route::resource('filter', 'Backend\Catalog\FilterController');
Route::get('filterDelete', ['as' => 'filterDelete', 'uses' => 'Backend\Catalog\FilterDeleteController@__invoke']);