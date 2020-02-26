<?php

namespace App\Http\Controllers\Frontend\Catalog;

use App\Models\Backend\Product;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('url', 'image')->latest()->get();

        return view('frontend.catalog.index', compact('products'));
    }
}
