<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Thumb extends Model
{
    protected $table = 'thumbs';

    public $timestamps = false;

    protected $fillable = [
        'url', 'width', 'height', 'thumbtable_id', 'thumbtable_type'
    ];

    public function thumbtable()
    {
        return $this->morphTo();
    }
}
