<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Input extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Input';
    }
}