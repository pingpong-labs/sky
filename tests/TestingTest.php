<?php

use Pingpong\Testing\TestCase;

class TestingTest extends TestCase {

    public function testOk()
    {
        $this->assertInstanceOf('Illuminate\Foundation\Application', $this->app);
    }
} 