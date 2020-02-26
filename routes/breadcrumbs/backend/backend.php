<?php

/**
 * Home
 */
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

/**
 * Page
 */
Breadcrumbs::for('admin.page.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Страницы', route('admin.page.index'));
});

Breadcrumbs::for('admin.page.create', function ($trail) {
    $trail->parent('admin.page.index');
    $trail->push('Создание страницы', route('admin.page.create'));
});
Breadcrumbs::for('admin.page.edit', function ($trail, $id) {
    $trail->parent('admin.page.index');
    $trail->push('Редактирование страницы', route('admin.page.edit', $id));
});

/**
 * Page category
 */
Breadcrumbs::for('admin.page_category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Категории', route('admin.page_category.index'));
});

Breadcrumbs::for('admin.page_category.create', function ($trail) {
    $trail->parent('admin.page_category.index');
    $trail->push('Создание категории', route('admin.page_category.create'));
});
Breadcrumbs::for('admin.page_category.edit', function ($trail, $id) {
    $trail->parent('admin.page_category.index');
    $trail->push('Редактирование категории', route('admin.page_category.edit', $id));
});

/**
 * File manager
 */
Breadcrumbs::for('admin.file_manager', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Файловый менеджер', route('admin.file_manager'));
});

/**
 * Catalog category
 */
Breadcrumbs::for('admin.catalog', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Каталог');
});
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.catalog');
    $trail->push('Категории', route('admin.category.index'));
});

Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push('Создание категории', route('admin.category.create'));
});
Breadcrumbs::for('admin.category.edit', function ($trail, $id) {
    $trail->parent('admin.category.index');
    $trail->push('Редактирование категории', route('admin.category.edit', $id));
});

/**
 * Catalog product
 */
Breadcrumbs::for('admin.product.index', function ($trail) {
    $trail->parent('admin.catalog');
    $trail->push('Товары', route('admin.product.index'));
});

Breadcrumbs::for('admin.product.create', function ($trail) {
    $trail->parent('admin.product.index');
    $trail->push('Создание товара', route('admin.product.create'));
});
Breadcrumbs::for('admin.product.edit', function ($trail, $id) {
    $trail->parent('admin.product.index');
    $trail->push('Редактирование товара', route('admin.product.edit', $id));
});

/**
 * Catalog attribute
 */
Breadcrumbs::for('admin.attribute.index', function ($trail) {
    $trail->parent('admin.catalog');
    $trail->push('Атрибуты', route('admin.attribute.index'));
});

Breadcrumbs::for('admin.attribute.create', function ($trail) {
    $trail->parent('admin.attribute.index');
    $trail->push('Создание атрибута', route('admin.attribute.create'));
});
Breadcrumbs::for('admin.attribute.edit', function ($trail, $id) {
    $trail->parent('admin.attribute.index');
    $trail->push('Редактирование атрибута', route('admin.attribute.edit', $id));
});

/**
 * Log
 */
Breadcrumbs::for('admin.logs', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Журнал ошибок');
});

/**
 * Menu
 */
Breadcrumbs::for('admin.menu.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Меню', route('admin.menu.index'));
});

Breadcrumbs::for('admin.menu.create', function ($trail) {
    $trail->parent('admin.menu.index');
    $trail->push('Создание меню', route('admin.menu.create'));
});
Breadcrumbs::for('admin.menu.edit', function ($trail, $id) {
    $trail->parent('admin.menu.index');
    $trail->push('Редактирование меню', route('admin.menu.edit', $id));
});

/**
 * News
 */
Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Новости', route('admin.news.index'));
});

Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->parent('admin.news.index');
    $trail->push('Создание новости', route('admin.news.create'));
});
Breadcrumbs::for('admin.news.edit', function ($trail, $id) {
    $trail->parent('admin.news.index');
    $trail->push('Редактирование новости', route('admin.news.edit', $id));
});

/**
 * Catalog filter
 */
Breadcrumbs::for('admin.filter.index', function ($trail) {
    $trail->parent('admin.catalog');
    $trail->push('Фильтры', route('admin.filter.index'));
});

Breadcrumbs::for('admin.filter.create', function ($trail) {
    $trail->parent('admin.filter.index');
    $trail->push('Создание фильтра', route('admin.filter.create'));
});
Breadcrumbs::for('admin.filter.edit', function ($trail, $id) {
    $trail->parent('admin.filter.index');
    $trail->push('Редактирование фильтра', route('admin.filter.edit', $id));
});