<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ID of the element
    |--------------------------------------------------------------------------
    |
    */
    'id' => 'app',

    /*
    |--------------------------------------------------------------------------
    | Tag attribute
    |--------------------------------------------------------------------------
    | 
    | It uses to find `a` tags that use ajax request
    |
    */
    'tag_attribute' => 'ajaxable',

    /*
    |--------------------------------------------------------------------------
    | Cache tag attribute
    |--------------------------------------------------------------------------
    |
    */
    'cache_attribute' => 'cache-for',

    /*
    |--------------------------------------------------------------------------
    | Configuration of NProgress.js
    |--------------------------------------------------------------------------
    | 
    | See for details: https://github.com/rstacruz/nprogress/#configuration
    |
    */
    'nprogress_config' => [
        'showSpinner' => false
    ]
    
];