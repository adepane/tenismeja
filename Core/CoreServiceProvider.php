<?php

namespace Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('core', function () {
            return new Core;
        });
    }
}
