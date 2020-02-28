<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Services\Image as Img;

class Image extends Model
{
    use Img;

    protected $table = 'images';

    public $timestamps = false;

    protected $fillable = [
        'url', 'imagetable_id', 'imagetable_type', 'primary', 'position', 'small', 'medium', 'large'
    ];

    public function imagetable()
    {
        return $this->morphTo();
    }
}
