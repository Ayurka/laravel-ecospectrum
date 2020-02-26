<?php

namespace App\Http\Controllers\Frontend\Catalog;

use App\Models\Backend\Product;
use App\Models\Backend\Url;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($path)
    {
        $url = Url::where('url', $path)->first();

        if ($url == null) {
            abort(404);
        }

        $model = $url->urltable;

        if ($model instanceof Product) {
            return $this->getProduct($model);
        }

        return $this->getCategory($model);
    }

    public function getProduct($model)
    {
        return view('frontend.catalog.product', compact('model'));
    }

    public function getCategory($model)
    {
        $products = Product::where('category_id', $model->id)->with('url', 'image')->get();

        return view('frontend.catalog.category', compact('model', 'products'));
    }
}
