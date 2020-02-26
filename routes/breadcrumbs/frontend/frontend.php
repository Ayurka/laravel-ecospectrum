<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', '/');
});

// Catalog
Breadcrumbs::for('catalog', function ($trail) {
    $trail->parent('home');
    $trail->push('Каталог', route('frontend.catalog'));
});

// Page or Category
Breadcrumbs::for('page', function ($trail, $page) {
    $trail->parent('home');

    if ($page instanceof \App\Models\Backend\Page) {
        if($page->category){
            if(count($page->category->ancestors) > 0){
                foreach ($page->category->ancestors as $ancestor) {
                    $trail->push($ancestor->title, route('frontend.page', ['path' => $ancestor->url['url']]));
                }
            }else{
                $trail->push($page->category->title, route('frontend.page', ['path' => $page->category->slug]));
            }
        }
        $trail->push($page->title, route('frontend.page', ['path' => $page->slug]));
    } else {
        foreach ($page->ancestors as $ancestor) {
            $trail->push($ancestor->title, route('frontend.page', ['path' => $ancestor->url['url']]));
        }
        $trail->push($page->title, route('frontend.page', ['path' => $page->slug]));
    }
});

// Product or Category
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('catalog');

    if ($product instanceof \App\Models\Backend\Product) {
        if($product->getCategory){
            if(count($product->getCategory->ancestors) > 0){
                foreach ($product->getCategory->ancestors as $ancestor) {
                    $trail->push($ancestor->title, route('frontend.product', ['path' => $ancestor->url['url']]));
                }
            }else{
                $trail->push($product->getCategory->title, route('frontend.product', ['path' => $product->getCategory->slug]));
            }
        }
        $trail->push($product->title, route('frontend.product', ['path' => $product->slug]));
    } else {
        foreach ($product->ancestors as $ancestor) {
            $trail->push($ancestor->title, route('frontend.product', ['path' => $ancestor->url['url']]));
        }
        $trail->push($product->title, route('frontend.product', ['path' => $product->slug]));
    }
});

// Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push('Оформление заказа', route('frontend.cart'));
});

// login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Вход', route('frontend.login'));
});

// Register
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push('Регистрация', route('frontend.register'));
});

// Register
Breadcrumbs::for('cabinet', function ($trail) {
    $trail->parent('home');
    $trail->push('Личный кабинет', route('frontend.cabinet.index'));
});