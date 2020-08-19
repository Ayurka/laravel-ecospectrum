<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class SearchProductsController extends Controller
{
    /**
     * Поиск товаров
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request)
    {
        //$products = Product::search('title:(' . $request->get('query') . ')')->get();
        $products = Product::search($request->get('query'))->get();

        return ProductResource::collection($products);
    }
}
