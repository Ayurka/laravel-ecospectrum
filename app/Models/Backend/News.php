<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use Sluggable;

    protected $table = 'news';

    protected $fillable = [
        'title', 'slug', 'announcement', 'description', 'public', 'seo_title', 'seo_keywords', 'seo_description'
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
        return $this->morphOne('App\Models\Backend\Image', 'imagetable')->where('primary', 1);
    }
}
