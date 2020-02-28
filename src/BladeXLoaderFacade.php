<?php

namespace Makhweb\BladeXLoader;

use Illuminate\Support\Facades\Facade;

class BladeXLoaderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BladeXLoader';
    }
}