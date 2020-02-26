<?php

Route::resource('menu', 'Backend\Menu\MenuController');
Route::post('menuSort', ['as' => 'menuSort', 'uses' => 'Backend\Menu\MenuSortController@__invoke']);
Route::get('menuType', ['as' => 'menuType', 'uses' => 'Backend\Menu\MenuTypeController@__invoke']);