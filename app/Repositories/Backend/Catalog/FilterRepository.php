<?php

namespace App\Repositories\Backend\Catalog;

use App\Models\Backend\Filter;
use App\Models\Backend\FilterGroup;
use App\Repositories\Backend\CrudRepositoryInterface;

class FilterRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new FilterGroup();
    }

    public function all()
    {
        return $this->model->with('filters')->get();
    }

    public function create(array $data)
    {
        return $this->model->create([
            'title' => $data['title_group']
        ]);
    }

    public function update(array $data, $id)
    {
        $model = $this->show($id);

        return $model->update([
            'title' => $data['title_group'],
        ]);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function showFilter($id)
    {
        return Filter::findOrFail($id);
    }

    public function createFilters($data, $id)
    {
        if($data->get('attr_new')){
            foreach ($data->get('attr_new') as $item) {
                Filter::create([
                    'filter_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }
        return true;
    }

    public function updateFilters($data, $id)
    {
        if($data->get('attr_old')) {
            foreach ($data->get('attr_old') as $item) {
                $attribute = $this->showFilter($item['id']);
                $attribute->update([
                    'filter_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }
        return true;
    }

}