<?php

class TestingTest extends PingpongTestCase {

    protected function registerBootedCallback($app)
    {
        include $app['path'] . '/Http/routes.php';
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function tearDown()
    {
        Mockery::close();
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
        $this->call('POST', '/post/data');
        $this->assertResponseStatus(500);
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