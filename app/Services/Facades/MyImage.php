<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class MyImage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'myImage';
    }
}