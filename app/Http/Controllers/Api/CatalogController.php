<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Backend\Product;
use App\Models\Backend\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function isUrl($path)
    {
        $url = Url::where('url', $path)->first();
        if ($url === null) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }

    /**
     * @param $path
     * @param Request $request
     * @return CategoryResource|ProductResource
     */
    public function index($path, Request $request)
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

    /**
     * @param $model
     * @return ProductResource
     */
    public function getProduct($model)
    {
        return new ProductResource($model);
    }

    /**
     * @param $model
     * @return CategoryResource
     */
    public function getCategory($model)
    {
        return new CategoryResource($model);
    }
}
