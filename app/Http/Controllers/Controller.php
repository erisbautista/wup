<?php

namespace App\Http\Controllers;

abstract class Controller
{
    
    
    protected function removeToken($data)
    {
        return array_filter($data, static function($var){return $var !== '_token';}, ARRAY_FILTER_USE_KEY );
    }

    protected function removeMethod($data)
    {
        return array_filter($data, static function($var){return $var !== '_method';}, ARRAY_FILTER_USE_KEY );
    }
}
