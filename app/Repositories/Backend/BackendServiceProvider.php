<?php

namespace App\Repositories\Backend;

use App\Http\Controllers\Backend\Catalog\AttributeController;
use App\Http\Controllers\Backend\Catalog\CategoryController;
use App\Http\Controllers\Backend\Catalog\FilterController;
use App\Http\Controllers\Backend\Catalog\ProductController;
use App\Http\Controllers\Backend\Menu\MenuController;
use App\Http\Controllers\Backend\News\NewsController;
use App\Http\Controllers\Backend\Page\PageCategoryController;
use App\Http\Controllers\Backend\Page\PageController;
use App\Repositories\Backend\Catalog\AttributeRepository;
use App\Repositories\Backend\Catalog\CategoryRepository;
use App\Repositories\Backend\Catalog\FilterRepository;
use App\Repositories\Backend\Catalog\ProductRepository;
use App\Repositories\Backend\Menu\MenuRepository;
use App\Repositories\Backend\News\NewsRepository;
use App\Repositories\Backend\Page\PageCategoryRepository;
use App\Repositories\Backend\Page\PageRepository;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(PageController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(PageRepository::class);

        $this->app
            ->when(PageCategoryController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(PageCategoryRepository::class);

        $this->app
            ->when(ProductController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(ProductRepository::class);

        $this->app
            ->when(CategoryController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(CategoryRepository::class);

        $this->app
            ->when(AttributeController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(AttributeRepository::class);

        $this->app
            ->when(MenuController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(MenuRepository::class);

        $this->app
            ->when(NewsController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(NewsRepository::class);

        $this->app
            ->when(FilterController::class)
            ->needs(CrudRepositoryInterface::class)
            ->give(FilterRepository::class);
    }
}
