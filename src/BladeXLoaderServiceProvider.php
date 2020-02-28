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
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
    * Get the Blogg route group configuration array.
    *
    * @return array
    */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "Makhweb\BladeXLoader\Http\Controllers",
            'middleware' => 'api',
            'prefix'     => 'api'
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('BladeXLoader', function () {
            return new BladeXLoader;
        });
    }

    public function publishThings(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/BladeXLoader.php' => config_path('BladeXLoader.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/publishable' => public_path('vendor/makhweb/blade-x-loader'),
            ], 'publishable');
        }
    }
}