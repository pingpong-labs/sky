<?php

use Mockery as m;
use Pingpong\Oembed\Oembed;

class OembedTest extends PHPUnit_Framework_TestCase {

    protected $embed;

    protected $cache;

    protected $oembed;

    public function setUp()
    {
        $this->embed = m::mock('Pingpong\Oembed\Embed');
        $this->cache = m::mock('Illuminate\Cache\Repository');
        $this->oembed = new Oembed($this->embed, $this->cache);
    }

    public function test_initialize()
    {
        $this->assertInstanceOf('Pingpong\Oembed\Oembed', $this->oembed);
    }

    public function test_get_info_from_a_specify_url()
    {
        $url = 'https://github.com/gravitano';

        $this->embed->shouldReceive('get')->once()->with($url, '')->andReturn(array('url' => $url));

        $info = $this->oembed->get($url);

        $this->assertTrue(is_array($info));
        $this->assertArrayHasKey('url', $info);
    }

    public function test_get_info_from_a_specify_url_but_false_returned()
    {
        $url = 'foo';

        $this->embed->shouldReceive('get')->once()->with($url, '')->andReturn(false);

        $info = $this->oembed->get($url);

        $this->assertFalse($info);
    }

    public function test_get_info_from_a_specify_url_and_also_use_laravel_cache_manager()
    {

        $url = 'https://www.youtube.com/watch?v=PP1xn5wHtxE';

        $this->embed->shouldReceive('get')->once()->with($url, '')->andReturn(array('url' => $url));
        $this->cache->shouldReceive('remember')->once()->andReturn(array('url' => $url));

        $info = $this->oembed->cache($url);

        $this->assertTrue(is_array($info));
        $this->assertArrayHasKey('url', $info);
    }

}