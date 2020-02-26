<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table = 'attribute_group';

    protected $fillable = ['title', 'position'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class)->orderBy('position');
    }
}
