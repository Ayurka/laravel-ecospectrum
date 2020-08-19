<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Получаем категории
     *
     * @param Category $category
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Category $category)
    {
        $categories = $category->where('public', 1)->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Получаем категорию
     *
     * @param $slug
     * @param Category $category
     * @return CategoryResource
     */
    public function show($slug, Category $category)
    {
        $category = $category->where('slug', $slug)->first();
        return new CategoryResource($category);
    }
}
