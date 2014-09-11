<?php namespace Pingpong\Oembed\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Oembed
 * 
 * @package Pingpong\Oembed\Facades
 * @author  Pingpong Labs <pingpong.labs@gmail.com>
 * @author  Gravitano <gravitano16@gmail.com>
 * @license https://github.com/pingpong-labs/oembed/blob/master/LICENSE MIT
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