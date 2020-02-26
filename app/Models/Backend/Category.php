<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
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

    public function getPivotProducts()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getPivotFilters()
    {
        return $this->belongsToMany(Filter::class, 'category_filter', 'category_id', 'filter_id');
    }

    public function getModelName()
    {
        return class_basename($this);
    }

    public function setPublicAttribute($value)
    {
        $this->attributes['public'] = $value ? 1 : 0;
    }

    public function url()
    {
        return $this->morphOne('App\Models\Backend\Url', 'urltable');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Backend\Image', 'imagetable');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Backend\Image', 'imagetable')->where('primary', 0)->orderBy('position', 'asc');
    }

    // Генерация пути
    public function generatePath()
    {
        $slugs = $this->ancestors()->pluck('slug')->toArray();
        $slugs[] = $this->slug;

        $path = implode('/', $slugs);

        return $path;
    }

    // Получение ссылки
    public function getUrl()
    {
        return $this->generatePath();
    }

    public function updateDescendantsPaths()
    {
        // Получаем всех потомков в древовидном порядке
        $descendants = $this->descendants()->defaultOrder()->get();

        // Данный метод заполняет отношения parent и children
        $descendants->push($this)->linkNodes()->pop();

        foreach ($descendants as $key => $model) {

            // обновляем путь категории
            $model->url()->update(['url' => $model->getUrl()]);

            // обновляем пути страниц
            foreach ($model->getProducts as $product) {
                $product->url()->update(['url' => $model->getUrl() . '/' . $product->slug]);
            }
        }
    }

    public function updateProductsPaths()
    {
        foreach ($this->getProducts as $product) {
            $product->url()->update(['url' => $this->getUrl() . '/' . $product->slug]);
        }
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->url()->update(['url' => $model->getUrl()]);
            }
        });

        static::saved(function (self $model) {
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            static $updating = false;

            if ( ! $updating && $model->isDirty('slug')) {



                $updating = true;

                $model->updateDescendantsPaths();

                $updating = false;
            }

            // обновляем путь продукта, если нет потомков
            $model->updateProductsPaths();
        });
    }
}
