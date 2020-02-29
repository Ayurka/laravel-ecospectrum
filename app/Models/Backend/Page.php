<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use Sluggable;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'announcement',
        'description',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'slug',
        'category_id',
        'public',
    ];

    /**
     * Получаем перевод страницы
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageLanguage()
    {
        return $this->hasMany('App\Models\Backend\PageLanguage');
    }

    /**
     * Добавляем ЧПУ
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
     * Получаем категорию
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Backend\PageCategory');
    }

    /**
     * Изменяем public
     *
     * @param $value string
     *
     * @return void
     */
    public function setPublicAttribute($value)
    {
        $this->attributes['public'] = $value ? 1 : 0;
    }

    /**
     * Получаем url
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function url()
    {
        return $this->morphOne('App\Models\Backend\Url', 'urltable');
    }

    /**
     * Получаем главное изображение
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Models\Backend\Image', 'imagetable')
            ->where('position', 0)
            ->select('small');
    }

    /**
     * Получаем список изображений
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Backend\Image', 'imagetable')
            ->orderBy('position', 'asc');
    }
}
