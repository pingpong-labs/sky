<?php namespace Pingpong\Presenters;

abstract class Presenter {

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
    
}