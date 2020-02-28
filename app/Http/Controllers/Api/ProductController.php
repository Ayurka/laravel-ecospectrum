<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Backend\Product;
use App\Http\Resources\Product as ProductResource;


class ProductController extends Controller
{
    /**
     * Получаем все товары
     *
     * @return ProductCollection
     */
    public function index()
    {
        $products = Product::with('images')->get();
        return new ProductCollection($products);
    }

    /**
     * Получаем товар
     *
     * @param $slug string
     * @return ProductResource
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return new ProductResource($product);
    }
}
