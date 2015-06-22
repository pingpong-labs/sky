<?php

class TestingTest extends \Pingpong\Testing\TestCase {

	public static function getLaravel()
	{
		return (new static)->createApplication();
	}

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

	public function getBasePath()
	{
		return realpath(__DIR__ . '/../fixture');
	}

	public function testHomepage()
	{
		$this->visit('/')
		     ->see('Laravel 5');
	}

	public function registerBootedCallback($app)
	{
		require $app['path'] . '/Http/routes.php';
	}
}