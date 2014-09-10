<?php

use Mockery as m;
use Pingpong\Oembed\Oembed;

class OembedTest extends PHPUnit_Framework_TestCase {

	public function setUp()
	{
		$this->embed = m::mock('Embed\Embed');
		$this->oembed = new Oembed($this->embed);
	}

	public function test_initialize()
	{
		$this->assertInstanceOf('Pingpong\Oembed\Oembed', $this->oembed);
	}

	public function test_get_info_from_a_specify_url()
	{
		$url = 'https://github.com/gravitano';
		$this->embed->shouldReceive('get')->once()->with($url)->andReturn(['url' => $url]);
		$info = $this->embed->get($url);

		$this->assertTrue(is_array($info));
		$this->assertArrayHasKey('url', $info);
	}

	public function test_get_info_from_a_specify_url_but_false_returned()
	{
		$url = 'foo';
		$this->embed->shouldReceive('get')->once()->with($url)->andReturn(false);
		$info = $this->embed->get($url);

		$this->assertFalse($info);
	}
}