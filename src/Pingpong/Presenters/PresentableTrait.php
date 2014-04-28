<?php namespace Pingpong\Presenters;

use Illuminate\Support\Facades\App;

/**
 * Class PresenterTrait
 * @package Acme\Presenters
 */
trait PresentableTrait
{
    /**
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function present()
	{
		if(is_null($this->presenter))
		{
			throw new \InvalidArgumentException("Presenter class must be defined.");
		}
		return App::make($this->presenter, array($this));
	}
}