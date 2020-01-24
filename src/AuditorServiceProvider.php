<?php

namespace CoolStudio\Auditor;

use Illuminate\Support\ServiceProvider;

class AuditorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }
}
