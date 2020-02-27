<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Backend\Page;

class PageController extends Controller
{
    /**
     * @return PageResource
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return new PageResource($page);
    }
}
