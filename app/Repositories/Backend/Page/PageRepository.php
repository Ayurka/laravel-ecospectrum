<?php

namespace App\Repositories\Backend\Page;

use App\Models\Backend\Page;
use App\Models\Backend\PageCategory;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Support\Arr;

class PageRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Page();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $number)
    {
        return $this->model->with('category')->orderBy('created_at', 'desc')->paginate($number);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->show($id);
        $model->update(Arr::add($data, 'public', false));

        return $model;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getTree()
    {
        return PageCategory::get()->toTree();
    }

    public function getCategoryTree()
    {
        $nodes = $this->getTree();
        $this->tree = [];

        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            $this->tree[0] = '- Без категории';
            foreach ($categories as $category) {
                $this->tree[$category->id]=  $prefix . ' ' . $category->title;

                $traverse($category->children, $prefix . '-');
            }
        };

        $traverse($nodes);

        return $this->tree;
    }

    public function createUrl($id)
    {
        $model = $this->show($id);
        if ($model->category) {
            $category_slug = $model->category->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->create(['url' => $slug]);
        } else {
            return $model->url()->create(['url' => $model->slug]);
        }
    }

    public function updateUrl($id)
    {
        $model = $this->show($id);
        if ($model->category) {
            $category_slug = $model->category->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->update(['url' => $slug]);
        } else {
            return $model->url()->update(['url' => $model->slug]);
        }
    }

    public function deleteUrl($id)
    {
        $model = $this->show($id);
        $model->url()->delete();
    }
}
