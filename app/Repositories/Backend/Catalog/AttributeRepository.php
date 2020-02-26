<?php

namespace App\Repositories\Backend\Catalog;

use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeGroup;
use App\Repositories\Backend\CrudRepositoryInterface;

class AttributeRepository implements CrudRepositoryInterface
{
    protected $model;
    protected $tree;

    public function __construct()
    {
        $this->model = new AttributeGroup();
    }

    public function all()
    {
        return $this->model->with('attributes')->get();
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

    public function showAttribute($id)
    {
        return Attribute::findOrFail($id);
    }

    public function createAttributes($data, $id)
    {
        if($data->get('attr_new')){
            foreach ($data->get('attr_new') as $item) {
                Attribute::create([
                    'attribute_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }
        return true;
    }

    public function updateAttributes($data, $id)
    {
        if($data->get('attr_old')) {
            foreach ($data->get('attr_old') as $item) {
                $attribute = $this->showAttribute($item['id']);
                $attribute->update([
                    'attribute_group_id' => $id,
                    'title' => $item['value'],
                    'position' => $item['position']
                ]);
            }
        }
        return true;
    }

}