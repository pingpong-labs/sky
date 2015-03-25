<?php namespace Pingpong\Oembed;

use Embed\Embed as BaseEmbed;

class Embed extends BaseEmbed {

    /**
     * Get info from a specify url.
     *
     * @param  string|Request $url The url or a request with the url
     * @param  array $options
     * @return \Embed\Adapters\AdapterInterface|false
     */
    public function get($url, array $options = null)
    {
        return static::create($url, $options);
    }

    /**
     * Gets the info from a source (list of urls)
     *
     * @param  string|Request $url The url or a request with the source url
     * @return \Embed\Sources\SourceInterface|false
     */
    public function source($url)
    {
        return static::createSource($url);
    }

}