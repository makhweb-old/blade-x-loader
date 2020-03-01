<?php

namespace Makhweb\BladeXLoader;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
        $this->addDirections();
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
                __DIR__ . '/../config/BladeXLoader.php' => config_path('blade-x-loader.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/../publishable' => public_path('vendor/makhweb/blade-x-loader'),
            ], 'publishable');
        }
    }

    /**
     * Get additions of Laravel Blade
     */
    private function bladeAdittions() : Collection
    {
        return new Collection([
            [
                'name' => 'ajax',
                'type' => 'if',
                'callback' => function () {
                    return Request::isAjax();
                }
            ]
        ]);
    }

    /**
     * Add directions to Laravel Blade
     */
    private function addDirections()
    {
        $this->bladeAdittions()->each(function($direction){
            call_user_func(
                [Blade::class, $direction->type],
                $direction->name,
                $direction->callback
            );
        });
    }
}