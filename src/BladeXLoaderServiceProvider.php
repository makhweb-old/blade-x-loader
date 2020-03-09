<?php

namespace Makhweb\BladeXLoader;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;

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

    public function publishThings()
    {
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
    private function bladeDirections() : array
    {
        return [
            [
                'name' => 'ajax',
                'type' => 'if',
                'callback' => function () {
                    return Request::ajax();
                }
            ],
            [
                'name' => 'notAjax',
                'type' => 'if',
                'callback' => function () {
                    return !Request::ajax();
                }
            ]
        ];
    }

    /**
     * Add directions to Laravel Blade
     */
    private function addDirections()
    {
        foreach($this->bladeDirections() as $direction){
            call_user_func(
                [Blade::class, $direction['type']],
                $direction['name'],
                $direction['callback']
            );
        };
    }
}
