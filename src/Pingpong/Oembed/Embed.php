<?php namespace Pingpong\Oembed;

use Embed\Embed as BaseEmbed;

/**
 * Class Embed
 * @package Pingpong\Oembed
 */
class Embed extends BaseEmbed
{
    /**
     * Get info from a specify url.
     *
     * @param $url
     * @param array $options
     * @return \Embed\Adapters\AdapterInterface|false
     */
    public function get($url, array $options = null)
    {
        return static::create($url, $options);
    }

    /**
     * Gets the info from a source (list of urls)
     *
     * @param $url
     * @return \Embed\Sources\SourceInterface|false
     */
    public function source($url)
    {
        return static::createSource($url);
    }

}