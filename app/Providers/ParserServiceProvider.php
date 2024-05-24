<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ParserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Parser', 'App\Services\ParserService');
    }
}
