<?php namespace Pingpong\Presenters;

/**
 * Class Presenter
 * @package Acme\Presenters
 */
abstract class Presenter
{
    /**
     * @var PresentableInterface
     */
    protected $resource;

    /**
     * @param PresentableInterface $resource
     */
    public function __construct(PresentableInterface $resource)
	{
		$this->resource = $resource;
	}

    /**
     * @return mixed
     */
    public function getResource()
	{
		return $this->resource;
	}

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
	{
		if(method_exists($this, $key))
		{
			return call_user_func(array($this, $key));
		}

		return $this->resource->{$key};
	}

    /**
     * @param $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters = array())
	{
		if(method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $parameters);
		}

		return call_user_func_array(array($this, $method), $parameters);
	}
}