<?php namespace Pingpong\Oembed\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Oembed
 * @package Pingpong\Oembed\Facades
 */
class Oembed extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'oembed';
    }

}