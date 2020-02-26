<?php

namespace App\Repositories\Backend\Page;

use App\Models\Backend\PageCategory;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Support\Arr;

class PageCategoryRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new PageCategory();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $number)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($number);
    }

    public function create(array $data)
    {
        if ($data['parent_id'] != '0') {
            $parent = $this->model->find($data['parent_id']);
            return $this->model->create($data, $parent);
        }
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

    public function getCategoryTree()
    {
        $nodes = $this->model->get()->toTree();

        $tree = [];

        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$tree) {
            $tree[0] = '- Главная категория';
            foreach ($categories as $category) {
                $tree[$category->id] =  $prefix . ' ' . $category->title;

                $traverse($category->children, $prefix . '-');
            }
        };

        $traverse($nodes);

        return $tree;
    }

    public function deleteUrl($id)
    {
        $model = $this->show($id);

        // удаляем пути потомков и обновляем пути страниц
        $descendants = $model->descendants()->get();
        foreach ($descendants as $descendant) {
            foreach ($descendant->pages as $page) {
                $page->url()->update(['url' => $page->slug]);
            }
            $descendant->url()->delete();
        }

        foreach ($model->pages as $page) {
            $page->url()->update(['url' => $page->slug]);
        }

        $model->url()->delete();
    }

}
