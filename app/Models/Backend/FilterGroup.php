<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $table = 'filter_group';

    protected $fillable = ['title', 'category_id', 'position'];

    public function filters()
    {
        return $this->hasMany(Filter::class)->orderBy('position');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getPivotCategories()
    {
        return $this->belongsToMany(Category::class, 'category_filter', 'filter_id', 'category_id');
    }
}
