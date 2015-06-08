<?php

class ThemeHelperTest extends PingpongTestCase {

    public function testHelper()
    {
        $theme = theme();
        $this->assertInstanceOf('Pingpong\Themes\Repository', $theme);
    }

    public function testGetConfig()
    {
    	theme()->setPath($this->app['path.base'] . '/themes');
        $config = theme()->config('default::foo');
        $this->assertEquals('bar', $config);
    }

    public function testView()
    {
    	theme()->setPath($this->app['path.base'] . '/themes');
    	theme()->registerNamespaces();
    	theme()->set('default');
    	$res = theme('index')->render();
    	$this->assertEquals($res, 'Hello');
    }
}