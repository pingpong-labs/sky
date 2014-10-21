<?php

use Pingpong\Presenters\Model;
use Pingpong\Presenters\Presenter;
use Pingpong\Presenters\PresentableTrait;
use Pingpong\Presenters\PresentableInterface;

class UserPresenter extends Presenter
{
	public function email()
	{
		return 'foo@domain.com';
	}
}

class UserModel implements PresentableInterface
{
	use PresentableTrait;

	protected $presenter = 'UserPresenter';
}

class TestPresenters extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->model = new UserModel;
	}

	public function testPresenterUsingMagicAccess()
	{
		return $this->assertEquals('foo@domain.com', $this->model->present()->email);
	}

	public function testCallMethod()
	{
		return $this->assertEquals('foo@domain.com', $this->model->present()->email());	
	}
}