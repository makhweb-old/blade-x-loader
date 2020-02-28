<?php

namespace Makhweb\BladeXLoader;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class BladeXLoaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/BladeXLoader.php', 'blade-x-loader');
        $this->publishThings();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blade-x-loader');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->registerRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function publishThings(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/BladeXLoader.php' => config_path('BladeXLoader.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/../publishable' => public_path('vendor/makhweb/blade-x-loader'),
            ], 'publishable');
        }
    }
}