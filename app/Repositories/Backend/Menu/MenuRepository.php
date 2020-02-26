<?php

namespace App\Repositories\Backend\Menu;

use App\Models\Backend\Category;
use App\Models\Backend\Menu;
use App\Models\Backend\Page;
use App\Models\Backend\PageCategory;
use App\Repositories\Backend\CrudRepositoryInterface;

class MenuRepository implements CrudRepositoryInterface
{
    protected $model;
    protected $tree;
    protected $type;

    public function __construct()
    {
        $this->model = new Menu();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        $this->type = $data['type_menu'];
        if ($this->type == 'pageCategory') {
            $this->type = 'page';
        }

        $this->model->title = $data['title'];
        $this->model->route = $this->type;
        $this->model->slug = !empty($data['slug']) ? $data['slug'] : null;
        $this->model->save();

        return $this->model;
    }

    public function update(array $data, $id)
    {
        $model = $this->show($id);
        return $model->update($data);
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
        return $this->model->orderBy('sort')->get()->toTree();
    }

    public function getCategoryTree()
    {
        $nodes = $this->getTree();
        $this->tree = [];

        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            foreach ($categories as $category) {
                $this->tree[$category->id]['title'] =  $prefix . ' ' . $category->title;

                $traverse($category->children, $prefix . '-');
            }
        };

        $traverse($nodes);

        return $this->tree;
    }

    public function getItemList($model)
    {
        switch ($model->route){
            case 'page': $items = Page::all();break;
            case 'pageCategory': $items = PageCategory::all();break;
            case 'catalogCategory': $items = Category::all();break;
            case 'catalog': $items = 'catalog';break;
            case 'contact': $items = 'contact';break;
            case 'link': $items = 'link';break;
        }

        return $items;
    }

}