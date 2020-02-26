<?php

namespace App\Repositories\Backend\Catalog;

use App\Models\Backend\Category;
use App\Models\Backend\Filter;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Support\Arr;

class CategoryRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Category();
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

    public function getAllFilters()
    {
        $data = [];

        if(Filter::with('filterGroup')->get()){
            foreach(Filter::with('filterGroup')->get() as $filter){
                $data[] = [
                    'id' => $filter->id,
                    'text' => $filter->filterGroup->title . ' -> ' . $filter->title
                ];
            }
        }
        return response()->json($data);
    }

    public function getDataSelect($category)
    {
        $data = [];

        if(Filter::with('getPivotCategories')->get()){
            foreach(Filter::with('filterGroup', 'getPivotCategories')->get() as $filter){
                $data[] = [
                    'id' => $filter->id,
                    'text' => $filter->filterGroup->title . ' -> ' . $filter->title,
                    'selected' => $this->isSelected($filter->id, $category->getPivotFilters)
                ];
            }
        }

        return response()->json($data);
    }

    function isSelected($filter_id, $pivotFilters)
    {
        if ($pivotFilters->contains($filter_id)) {
            return true;
        }
        return false;
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

        // удаляем пути потомков и обновляем пути продуктов
        $descendants = $model->descendants()->get();
        foreach ($descendants as $descendant) {
            foreach ($descendant->getProducts as $product) {
                $product->url()->update(['url' => $product->slug]);
            }
            $descendant->url()->delete();
        }

        foreach ($model->getProducts as $product) {
            $product->url()->update(['url' => $product->slug]);
        }

        $model->url()->delete();
    }

}
