<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    protected $fillable = ['attribute_group_id', 'title', 'position'];

    public function attributeGroup()
    {
        return $this->belongsToMany(AttributeGroup::class);
    }

    public function getPivotProducts()
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'attribute_id', 'product_id');
    }
}
