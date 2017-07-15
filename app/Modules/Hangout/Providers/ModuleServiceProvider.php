<?php

namespace App\Modules\Hangout\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'hangout');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'hangout');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'hangout');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
