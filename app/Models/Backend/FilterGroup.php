<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $table = 'filter_group';

    protected $fillable = ['title', 'position'];

    public function filters()
    {
        return $this->hasMany(Filter::class)->orderBy('position');
    }
}
