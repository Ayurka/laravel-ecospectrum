<?php

namespace App\Repositories\Backend\Catalog;

use App\Models\Backend\Category;
use App\Models\Backend\Filter;
use App\Models\Backend\FilterGroup;
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

    public function getFilterGroups ()
    {
        $data = [];

        $filterGroups = FilterGroup::all();

        if($filterGroups) {
            foreach($filterGroups as $group){
                $data[] = [
                    'id' => $group->id,
                    'text' => $group->title
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

    public function getFilterGroupSelected($category)
    {
        $data = [];

        if(FilterGroup::with('getPivotCategories')->get()){
            foreach(FilterGroup::with('getPivotCategories')->get() as $filter){
                $data[] = [
                    'id' => $filter->id,
                    'text' => $filter->title,
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

    public function createOrUpdateFilters($request, $categoryId)
    {
        if ($request->has('groupList')) {
            foreach ($request->groupList as $group) {
                if (isset($group['groupNew'])) {
                    $filterGroup = FilterGroup::create([
                        'title' => $group['groupNew'],
                        'category_id' => $categoryId,
                        'position' => 0
                    ]);
                    foreach ($group['paramsNew'] as $item) {
                        Filter::create([
                            'filter_group_id' => $filterGroup->id,
                            'title' => $item,
                            'position' => 0
                        ]);
                    }
                } else {
                    $filterGroup = FilterGroup::findOrFail($group['groupOld']['id']);
                    $filterGroup->update([
                        'title' => $group['groupOld']['name'],
                        'category_id' => $categoryId,
                        'position' => 0
                    ]);
                    if (isset($group['paramsNew'])) {
                        foreach ($group['paramsNew'] as $item) {
                            Filter::create([
                                'filter_group_id' => $filterGroup->id,
                                'title' => $item,
                                'position' => 0
                            ]);
                        }
                    } else {
                        foreach ($group['paramsOld'] as $item) {
                            $filter = Filter::findOrFail($item['id']);
                            $filter->update([
                                'filter_group_id' => $filterGroup->id,
                                'title' => $item['name'],
                                'position' => 0
                            ]);
                        }
                    }
                }
            }
        }
        /*if($data->get('attr_new')){
            foreach ($data->get('attr_new') as $item) {
                Filter::create([
                    'filter_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }*/
    }

    public function updateFilters($request, $id)
    {
        /*if($data->get('attr_old')) {
            foreach ($data->get('attr_old') as $item) {
                $attribute = $this->showFilter($item['id']);
                $attribute->update([
                    'filter_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }*/
    }

    public function getFilters($category)
    {
        $data = [];

        if (count($category->getGroupsFilters) > 0) {
            foreach ($category->getGroupsFilters as $filterGroup) {
                $data[] = [
                    'groupName' => [
                        'id' => $filterGroup->id,
                        'type' => 'old',
                        'name' => $filterGroup->title
                    ],
                    'params' => $this->getParams($filterGroup->filters)
                ];
            }
        }

        return response()->json($data)->content();
    }

    public function getParams($params)
    {
        $data = [];

        foreach ($params as $param) {
            $data[] = [
                'id' => $param->id,
                'type' => 'old',
                'name' => $param->title
            ];
        }

        return $data;
    }

}
