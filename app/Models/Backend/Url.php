<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    public $timestamps = false;

    protected $fillable = [
        'url', 'urltable_id', 'urltable_type'
    ];

    public function urltable()
    {
        return $this->morphTo();
    }
}
