<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'model',
        'price',
        'quantity',
        'description',
        'public',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

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

    public function getPivotCategories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getPivotFilters()
    {
        return $this->belongsToMany(Filter::class, 'product_filter', 'product_id', 'filter_id');
    }

    public function getModelName()
    {
        return class_basename($this);
    }

    public function setPublicAttribute($value)
    {
        $this->attributes['public'] = $value ? 1 : 0;
    }

    public function getPivotAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id')
            ->select('id', 'attribute_group_id', 'title', 'position')
            ->withPivot('text');
    }

    public function url()
    {
        return $this->morphOne('App\Models\Backend\Url', 'urltable');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Backend\Image', 'imagetable')
            ->where('position', 0)
            ->select('small');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Backend\Image', 'imagetable')
            ->orderBy('position', 'asc');
    }
}
