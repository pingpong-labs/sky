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
        $this->cache = m::mock('Illuminate\Cache\Repository');
        $this->theme = new Repository(
            $this->finder,
            $this->config,
            $this->view,
            $this->lang,
            $this->cache
        );

        $this->theme->setPath($this->getPath());
    }

    public function getTheme($name = 'foo')
    {
        return new Theme([
            'name' => $name
        ]);
    }

    public function testGetAllThemesAndWillReturnFromFinder()
    { 
        $this->config->shouldReceive('get')
            ->once()
            ->andReturn(false);

        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->once()
                     ->andReturn([
                        $this->getTheme()
                    ]);
                     

        $themes = $this->theme->all();
        $this->assertTrue(is_array($themes));
    }

    public function testGetAllThemesAndWillReturnFromCache()
    { 
        $this->config->shouldReceive('get')
            ->times(2)
            ->andReturn(true);

        $this->cache->shouldReceive('get')
            ->once()
            ->andReturn([
                [
                    'name' => 'foo'
                ],
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
        $this->config->shouldReceive('get')
            ->once()
            ->andReturn(false);

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
        $this->config->shouldReceive('get')
            ->times(3)
            ->andReturn(false);

        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->times(3)
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

    public function testArrayableOfTheme()
    {
        $theme = new Theme([
            'name' => 'foo',
            'description' => 'foo theme',
            'author' => [
                'name' => 'Pingpong Labs',
                'email' => 'pingpong.labs@gmail.com'
            ],
            'enabled' => true,
        ]);

        $array = $theme->toArray();

        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('description', $array);
        $this->assertArrayHasKey('author', $array);
        $this->assertArrayHasKey('enabled', $array);
    }

    public function testGetAllThemesAsArray()
    {
        $this->finder->shouldReceive('find')
                     ->with($this->getPath(), 'theme.json')
                     ->once()
                     ->andReturn([
                        $this->getTheme(),
                        $this->getTheme('bar')
                    ]);

        $themes = $this->theme->toArray();

        $this->assertTrue(is_array($themes));
        $this->assertArrayHasKey(0, $themes);
        $this->assertArrayHasKey(1, $themes);
    }
}