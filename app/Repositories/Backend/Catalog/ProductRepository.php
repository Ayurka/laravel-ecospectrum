<?php

namespace App\Repositories\Backend\Catalog;

use App\Models\Backend\AttributeGroup;
use App\Models\Backend\Category;
use App\Models\Backend\Filter;
use App\Models\Backend\Product;
use App\Repositories\Backend\CrudRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Collection;

class ProductRepository implements CrudRepositoryInterface
{
    protected $model;
    protected $tree;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $number)
    {
        return $this->model->with('getCategory')->orderBy('created_at', 'desc')->paginate($number);
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
        return Category::get()->toTree();
    }

    public function getAllCategoriesWith()
    {
        return Category::with('getPivotProducts')->get();
    }

    public function getAllCategories()
    {
        $data = [];

        if(Category::all()){
            foreach(Category::all() as $category){
                $data[] = [
                    'id' => $category->id,
                    'text' => $category->title
                ];
            }
        }

        return response()->json($data);
    }

    public function getCategoryTree()
    {
        $nodes = $this->getTree();

        $this->tree = [];

        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            $this->tree[0] = '- Без категории';
            foreach ($categories as $category) {
                $this->tree[$category->id] =  $prefix . ' ' . $category->title;
                $traverse($category->children, $prefix . '-');
            }
        };

        $traverse($nodes);

        return $this->tree;
    }

    public function getDataSelect($product)
    {
        $data = [];

        if($this->getAllCategoriesWith()){
            foreach($this->getAllCategoriesWith() as $category){
                $data[] = [
                    'id' => $category->id,
                    'text' => $category->title,
                    'selected' => $this->isSelected($category->id, $product->getPivotCategories)
                ];
            }
        }

        return response()->json($data);
    }

    function isSelected($category_id, $pivotCategories)
    {
        if ($pivotCategories->contains($category_id)) {
            return true;
        }
        return false;
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

    public function getDataFilters($product)
    {
        $data = [];

        if(Filter::with('getPivotProducts')->get()){
            foreach(Filter::with('filterGroup', 'getPivotProducts')->get() as $filter){
                $data[] = [
                    'id' => $filter->id,
                    'text' => $filter->filterGroup->title . ' -> ' . $filter->title,
                    'selected' => $this->isSelectedFilter($filter->id, $product->getPivotFilters)
                ];
            }
        }

        return response()->json($data);
    }

    function isSelectedFilter($filter_id, $pivotFilters)
    {
        if ($pivotFilters->contains($filter_id)) {
            return true;
        }
        return false;
    }

    public function getAttributeGroups()
    {
        $data = [];
        $attributeGroups = AttributeGroup::with('attributes')->get();

        if($attributeGroups){
            foreach ($attributeGroups as $key => $group){
                $data[$key]['text'] = $group->title;
                $data[$key]['children'] = $this->getAttributes($group);
            }
        }

        return $data;
    }

    public function getAttributes($group)
    {
        $data = [];

        foreach($group->attributes as $key => $attribute){
            $data[$key]['id'] = $attribute->id;
            $data[$key]['text'] = $attribute->title;
        }

        return $data;
    }

    /**
     * @param $data Collection
     * @param $model Model
     *
     * @return void
     */
    public function pivotAttributeProduct($data, $model)
    {
        $result = [];
        if($data->get('attribute_product')){
            foreach($data->get('attribute_product') as $item){
                $result[$item['id']] = ['text' => $item['text']];
            }

            $model->getPivotAttributes()->sync($result);
        }
    }

    public function createUrl($id)
    {
        $model = $this->show($id);
        if ($model->getCategory) {
            $category_slug = $model->getCategory->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->create(['url' => $slug]);
        }
        return $model->url()->create(['url' => $model->slug]);
    }

    public function updateUrl($id)
    {
        $model = $this->show($id);
        if ($model->getCategory) {
            $category_slug = $model->getCategory->url->url;
            $slug = $category_slug . '/' . $model->slug;
            return $model->url()->update(['url' => $slug]);
        }
        return $model->url()->update(['url' => $model->slug]);
    }

    public function deleteUrl($id)
    {
        $model = $this->show($id);
        $model->url()->delete();
    }
}
