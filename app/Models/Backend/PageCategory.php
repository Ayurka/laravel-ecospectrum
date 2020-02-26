<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class PageCategory extends Model
{
    use NodeTrait, Sluggable {
        NodeTrait::replicate insteadof Sluggable;
        Sluggable::replicate as replicateSlug;
    }

    protected $table = 'page_categories';

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
        'public',
        'seo_title',
        'seo_keywords',
        'seo_description'
    ];

    /**
     * Получаем список страниц
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('App\Models\Backend\Page', 'category_id');
    }

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

    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
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
        return $this->morphOne('App\Models\Backend\Image', 'imagetable');
    }

    /**
     * Получаем список изображений
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Backend\Image', 'imagetable')->where('primary', 0)->orderBy('position', 'asc');
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
     * Генерация пути
     *
     * @return string
     */
    public function generatePath()
    {
        $slugs = $this->ancestors()->pluck('slug')->toArray();
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
            foreach ($model->pages as $page) {
                $page->url()->update(['url' => $model->getUrl() . '/' . $page->slug]);
            }
        }
    }

    /**
     * Обновляем путь страницы, если нет потомков
     *
     * @return void
     */
    public function updatePagePaths()
    {
        foreach ($this->pages as $page) {
            $page->url()->update(['url' => $this->getUrl() . '/' . $page->slug]);
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
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            static $updating = false;

            if ( ! $updating && $model->isDirty('slug')) {

                $updating = true;

                $model->updateDescendantsPaths();

                $updating = false;
            }

            $model->updatePagePaths();
        });
    }
}
