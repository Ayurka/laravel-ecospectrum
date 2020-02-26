<?php

Route::resource('page', 'Backend\Page\PageController');
Route::resource('page_category', 'Backend\Page\PageCategoryController');
Route::post('page_category/sort', ['as' => 'page_category.sort', 'uses' => 'Backend\Page\PageCategoryController@sort']);