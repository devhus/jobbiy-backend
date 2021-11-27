<?php

use App\Helpers\Responses;

if (!function_exists('res')) {
    /**
     * Return an optional HTTP response with the success or error methods.
     *
     * @return \App\Helpers\Responses
     */
    function res()
    {
        return new Responses();
    }
}
