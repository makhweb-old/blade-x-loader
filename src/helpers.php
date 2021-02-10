<?php

/**
 * Custom helper functions
 */

/**
 * Checks the request is pjax and returns necessary layout
 * 
 * @param string $default
 * 
 * @return string
 */
if (!function_exists('pjaxLayout')) {
    function pjaxLayout($default)
    {
        return
            request()->pjax()
            ? "blade-x-loader::layout"
            : $default;
    }
}
