<?php

abstract class ShortcodeTestCase extends PingpongTestCase {

	protected function getPackageAliases()
	{
		return ['Shortcode' => 'Pingpong\Shortcode\ShortcodeFacade'];
	}

	protected function getPackageProviders()
	{
		return  ['Pingpong\Shortcode\ShortcodeServiceProvider'];
	}

}

class FacadeTest extends ShortcodeTestCase {

	public function testUsingFacade()
	{
		Shortcode::register('foo', function () 
		{
			return 'bar';
		});

		$this->assertEquals('foo', Shortcode::compile('foo'));
	}

}