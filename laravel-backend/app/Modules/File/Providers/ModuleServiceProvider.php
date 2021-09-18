<?php

namespace App\Modules\File\Providers;

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
        $this->loadTranslationsFrom(module_path('file', 'Resources/Lang', 'app'), 'file');
        $this->loadViewsFrom(module_path('file', 'Resources/Views', 'app'), 'file');
        $this->loadMigrationsFrom(module_path('file', 'Database/Migrations', 'app'), 'file');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('file', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('file', 'Database/Factories', 'app'));
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
