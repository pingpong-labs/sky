<?php

use Mockery as m;
use Pingpong\Themes\Repository;
use Pingpong\Themes\Theme;

class ThemeTest extends PHPUnit_Framework_TestCase {

    function tearDown()
    {
        m::close();
    }

    protected function getPath()
    {
        return __DIR__ . '/../../fixture/themes/';
    }

    public function setUp()
    {
        $this->finder = m::mock('Pingpong\Themes\Finder');
        $this->config = m::mock('Illuminate\Config\Repository');
        $this->view = m::mock('Illuminate\View\Factory');
        $this->lang = m::mock('Illuminate\Translation\Translator');
        $this->theme = new Repository($this->finder, $this->config, $this->view, $this->lang);
        $this->theme->setPath($this->getPath());
    }

    public function getTheme($name = 'foo')
    {
        return new Theme([
            'name' => $name
        ]);
    }

    public function testGetAllThemes()
    { 
        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->once()
                     ->andReturn([
                        $this->getTheme()
                    ]);
        $themes = $this->theme->all();
        $this->assertTrue(is_array($themes));
    }

    public function testSetAndGetThemePath()
    {
        $this->theme->setPath('path/to');
        $this->assertEquals('path/to', $this->theme->getPath());
    }

    public function testRegisterNamespaces()
    {        
        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->once()
                     ->andReturn([
                        $this->getTheme()
                    ]);
        $this->view->shouldReceive('addNamespace')->once();
        $this->lang->shouldReceive('addNamespace')->once();
        $themes = $this->theme->registerNamespaces();
    }

    public function testGetThemePathForSpecifiedTheme()
    {
        $this->theme->setPath('path/to');
        $themePath = $this->theme->getThemePath('default');
        $this->assertEquals('path/to/default', $themePath);
    }

    public function testSetAndGetCurrentTheme()
    {
        $this->theme->setCurrent('foo');
        $this->assertEquals('foo', $this->theme->getCurrent());
    }

    public function testHasTheme()
    {        
        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->once()
                     ->andReturn([
                        $this->getTheme(),
                        $this->getTheme('bar')
                    ]);
        $this->assertTrue($this->theme->has('foo'));
        $this->assertTrue($this->theme->exists('bar'));
        $this->assertFalse($this->theme->has('baz'));
    }

    public function testLoadViewFromCurrentTheme()
    {
        $this->config->shouldReceive('get')->once()->andreturn('foo');
        $this->view->shouldReceive('make')->once()->andreturn('bar');
        $response = $this->theme->view('index');
        $this->assertEquals('bar', $response);
    }

    public function testLoadLangFromCurrentTheme()
    {
        $this->config->shouldReceive('get')->once()->andreturn('foo');
        $this->lang->shouldReceive('get')->once()->andreturn('bar');
        $result = $this->theme->lang('index');
        $this->assertEquals('bar', $result);
    }

}