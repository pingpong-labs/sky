<?php

use Pingpong\Testing\TestCase;

class TestingTest extends TestCase {

    protected function registerBootedCallback()
    {
        include __DIR__ . '/../src/fixture/app/routes.php';
    }

    public function testOk()
    {
        $this->assertInstanceOf('Illuminate\Foundation\Application', $this->app);
    }

    public function testGetHomepage()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
    }

    public function testPostDataAndWillThrowRuntimeException()
    {
        $this->setExpectedException('RuntimeException', 'Validation failed');
        $this->call('POST', '/post/data');
        $this->assertResponseOk();
    }
    public function testPostDataAdnWillReturnAResponse()
    {
        $this->call('POST', '/post/data', [
            'username' => 'John Done',
            'password' => 'foo'
        ]);
        $this->assertResponseOk();
    }
} 