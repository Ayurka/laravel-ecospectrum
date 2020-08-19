<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use NodeTrait, Sluggable {
        NodeTrait::replicate insteadof Sluggable;
        Sluggable::replicate as replicateSlug;
    }

    protected $table = 'categories';

    protected $fillable = [
        'title', 'slug', 'parent_id', 'description', 'public', 'seo_title', 'seo_keywords', 'seo_description'
    ];

    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Получаем продукты через pivot таблицы category_product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPivotProducts()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    /**
     * Получаем продукты по category_id
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->orderBy('price', 'asc');
    }

    /**
     * Получаем предков для хлебных крошек
     *
     * @return mixed
     */
    public function getAncestorsBreadcrumbs()
    {
        return $this->ancestors()->defaultOrder()->get();
    }

    /**
     * Получение минимальной цены
     *
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->min('price');
    }

    /**
     * Получение максимальной цены
     *
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->max('price');
    }

    /**
     * Получение групп фильтров
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getGroupsFilters()
    {
        return $this->hasMany(FilterGroup::class, 'category_id', 'id');
    }

    /**
     * Получаем группу фильтров через pivot таблицы category_filter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPivotFilters()
    {
        return $this->belongsToMany(FilterGroup::class, 'category_filter', 'category_id', 'filter_id');
    }

    /**
     * Получаем класс
     *
     * @return string
     */
    public function getModelName()
    {
        return class_basename($this);
    }

    /**
     * Переопределяем поле public
     *
     * @param $value
     * @return void
     */
    public function setPublicAttribute($value)
    {
        $this->attributes['public'] = $value ? 1 : 0;
    }

    /**
     * Получаем url данной категории
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function url()
    {
        return $this->morphOne('App\Models\Backend\Url', 'urltable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Models\Backend\Image', 'imagetable');
    }

    /**
     * Получаем изображения
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Backend\Image', 'imagetable')->orderBy('position', 'asc');
    }

    /**
     * Генерация пути
     *
     * @return string
     */
    public function generatePath()
    {
        $slugs = $this->ancestors()->defaultOrder()->pluck('slug')->toArray();
        $slugs[] = $this->slug;

        $path = implode('/', $slugs);

        return $path;
    }

    /**
     * Получение ссылки
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->generatePath();
    }

    /**
     * @return void
     */
    public function updateDescendantsPaths()
    {
        /** Получаем всех потомков в древовидном порядке */
        $descendants = $this->descendants()->defaultOrder()->get();

        /** Данный метод заполняет отношения parent и children */
        $descendants->push($this)->linkNodes()->pop();

        foreach ($descendants as $key => $model) {

            /** обновляем путь категории */
            $model->url()->update(['url' => $model->getUrl()]);

            /** обновляем пути страниц */
            foreach ($model->getProducts as $product) {
                $product->url()->update(['url' => $model->getUrl() . '/' . $product->slug]);
            }
        }
    }

    /**
     * Обновляем путь страницы, если нет потомков
     *
     * @return void
     */
    public function updateProductsPaths()
    {
        foreach ($this->getProducts as $product) {
            $product->url()->update(['url' => $this->getUrl() . '/' . $product->slug]);
        }
    }

    /**
     * Обновляем путь в таблице url
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->url()->update(['url' => $model->getUrl()]);
            }
        });

        static::saved(function (self $model) {
            /** Данная переменная нужна для того, чтобы потомки не начали вызывать метод, т.к. для них путь также изменится */
            static $updating = false;

            if ( ! $updating && $model->isDirty('slug')) {



                $updating = true;

                $model->updateDescendantsPaths();

                $updating = false;
            }

            /** обновляем путь продукта, если нет потомков */
            $model->updateProductsPaths();
        });
    }

    /**
     * Фильтруем товары
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function filterProducts($request, $id)
    {
        $queryBuilder = Product::where('category_id', $id)->where('public', 1);

        if ($request->has('range')) {
            $queryBuilder->whereBetween('price', $request->get('range'));
        }

        if ($request->has('filter')) {
            $filters = collect(json_decode($request->get('filter')));
            foreach($filters as $key => $item) {
                if (!empty($item)) {
                    $productIds = DB::table('product_filter')
                        ->whereIn('filter_id', $item)
                        ->pluck('product_id');
                    $queryBuilder->whereIn('id', $productIds);
                }
            }
        }

        if ($request->has('sort')) {
            if ($request->get('sort') === 'По возрастанию цены') {
                $queryBuilder->orderBy('price', 'asc');
            } elseif ($request->get('sort') ==='По убыванию цены') {
                $queryBuilder->orderBy('price', 'desc');
            } else {
                $queryBuilder->orderBy('title', 'asc');
            }
        }

        return $queryBuilder;
    }
}
