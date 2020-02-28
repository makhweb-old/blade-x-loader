<?php

/**
 * Custom helper functions
 */


/**
 * Checks the request is ajax and returns necessary layout
 * 
 * @param string $default
 * @param string $ajax
 * 
 * @return string
 */

if( !function_exists('fromLayout') ){
    function fromLayout($default){
        return 
            request()->ajax() 
            ? "blade-x-loader::layout" 
            : $default;
    }
}