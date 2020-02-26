<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table = 'filters';

    protected $fillable = ['filter_group_id', 'title', 'position'];

    public function filterGroup()
    {
        return $this->belongsTo(FilterGroup::class);
    }

    public function getPivotCategories()
    {
        return $this->belongsToMany(Category::class, 'category_filter', 'filter_id', 'category_id');
    }

    public function getPivotProducts()
    {
        return $this->belongsToMany(Product::class, 'product_filter', 'filter_id', 'product_id');
    }
}
