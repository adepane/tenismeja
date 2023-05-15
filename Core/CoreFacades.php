<?php

namespace Core;

use Illuminate\Support\Facades\Facade;

class CoreFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}
