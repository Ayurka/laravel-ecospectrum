<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Backend\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('image')->get();
        return new ProductCollection($products);
    }
}
