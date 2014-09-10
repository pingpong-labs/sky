<?php namespace Pingpong\Oembed;

use Illuminate\Cache\Repository;

/**
 * Class Oembed
 * @package Pingpong\Oembed
 */
class Oembed {
	
	/**
	 * The Embed instance.
	 * 
	 * @var \Pingpong\Oembed\Embed
	 */
	protected $embed;

    /**
     * The Cache Repository.
     *
     * @var Repository
     */
    protected  $cache;

    /**
	 * The constructor.
	 * 
	 * @param Embed $embed
	 */
	public function __construct(Embed $embed, Repository $cache)
	{
		$this->embed = $embed;
        $this->cache = $cache;
    }

	/**
	 * Get info from a specify url.
	 * 
	 * @param  string 		$url
	 * @param  null|array   $options
	 * @return false|\Embed\Adapters\AdapterInterface
	 */
	public function get($url, array $options = null)
	{
        return $this->embed->get($url, $options);
    }

    /**
     * Get info from a specify url and cache that using laravel cache manager.
     *
     * @param  string       $url
     * @param  null|array   $options
     * @return mixed
     */
    public function cache($url, array $options = null)
    {
        $lifetime = array_get($options, 'lifetime', 60);

        array_forget($options, 'lifetime');

        $info = $this->get($url, $options);

        return $this->cache->remember($url, $lifetime, function() use ($info)
        {
            return $info;
        });
    }

	/**
	 * Gets the info from a source (list of urls).
	 * 
     * @param  string|Request  $url  The url or a request with the source url
     * @return false|\Embed\Sources\SourceInterface
	 */
	public function createSource($url)
	{
		return $this->embed->source($url);
	}

}