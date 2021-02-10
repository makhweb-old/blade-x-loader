<?php

namespace Makhweb\BladeXLoade\Providers;

use Illuminate\Support\ServiceProvider;
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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blade-x-loader');
        $this->addDirections();
    }

    public function publishThings()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/BladeXLoader.php' => config_path('blade-x-loader.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/../publishable' => public_path('vendor/makhweb/blade-x-loader'),
            ], 'publishable');
        }
    }

    /**
     * Get additions of Laravel Blade
     */
    private function bladeDirections(): array
    {
        return [
            [
                'name' => 'pjax',
                'type' => 'if',
                'callback' => function () {
                    return Request::pjax();
                }
            ],
            [
                'name' => 'notPjax',
                'type' => 'if',
                'callback' => function () {
                    return !Request::pjax();
                }
            ]
        ];
    }

    /**
     * Add directions to Laravel Blade
     */
    private function addDirections()
    {
        foreach ($this->bladeDirections() as $direction) {
            call_user_func(
                [Blade::class, $direction['type']],
                $direction['name'],
                $direction['callback']
            );
        };
    }
}
