<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Models\Backend\Page;
use App\Models\Backend\PageCategory;
use App\Models\Backend\Url;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request, $path)
    {
        $url = Url::where('url', $path)->first();

        $model = $url->urltable;

        if ($model instanceof Page) {
            return $this->getPage($model);
        }

        return $this->getCategory($model);
    }

    public function getPage($model)
    {
        return view('frontend.page.page', compact('model'));
    }

    public function getCategory($model)
    {
        return view('frontend.page.category', compact('model'));
    }
}
