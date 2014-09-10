<?php namespace Pingpong\Oembed;

use Embed\Embed;

class Oembed {
	
	/**
	 * The Embed instance.
	 * 
	 * @var \Embed\Embed
	 */
	protected $embed;

	/**
	 * The constructor.
	 * 
	 * @param Embed $embed
	 */
	public function __construct(Embed $embed)
	{
		$this->embed = $embed;		
	}

	/**
	 * Get info from a specify url.
	 * 
	 * @param  string 		$url
	 * @param  null|array   $options
	 * @return false|Adapters\AdapterInterface
	 */
	public function get($url, array $options = null)
	{
		return $this->embed->create($url, $options);
	}

	/**
	 * Gets the info from a source (list of urls).
	 * 
     * @param  string|Request  $url  The url or a request with the source url
     * @return false|Sources\SourceInterface
	 */
	public function createSource($url)
	{
		return $this->embed->createSource($url);
	}

}