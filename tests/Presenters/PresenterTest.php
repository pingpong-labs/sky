<?php

use Pingpong\Presenters\PresentableInterface;
use Pingpong\Presenters\PresentableTrait;
use Pingpong\Presenters\Presenter;

class UserPresenter extends Presenter {

    public function email()
    {
        return 'foo@domain.com';
    }
}

class UserModel implements PresentableInterface {

    use PresentableTrait;

    protected $presenter = 'UserPresenter';

}

class PresenterTest extends PHPUnit_Framework_TestCase {

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