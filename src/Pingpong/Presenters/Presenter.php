<?php namespace Pingpong\Presenters;

abstract class Presenter
{
	/**
	 * @var $resource
	 */
	protected $resource;

	/**
	 * Store new resource to the main class.
	 * 
	 * @param  mixed  $resource
	 * @return void
	 */
	public function __construct($resource)
	{
		$this->resource = $resource;
	}

	/**
	 * Get the current resource.
	 * 
	 * @return mixed
	 */
	public function getResource()
	{
		return $this->resource;
	}

	/**
	 * Get property.
	 *
	 * @param  string  $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if(method_exists($this, $name))
		{
			return call_user_func_array([$this, $name], []);
		}
		$resource = $this->resource;
		return isset($resource->$name) ? $resource->$name : null;
	}

	/**
	 * Get called method.
	 *
	 * @param  string  $name
	 * @param  array   $args
	 * @return mixed
	 */
	public function __call($method, $args = [])
	{
		if(method_exists($this, $method))
		{
			return call_user_func_array([$this, $method], $args);
		}
		return $this->resource->$method($args);
	}
}

