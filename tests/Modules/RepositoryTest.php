<?php

use Pingpong\Modules\Repository;

class RepositoryTest extends PingpongTestCase {

    /**
     * @var Repository
     */
    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = new Repository($this->app, $this->getPath());
    }

    public function getPath()
    {
        return realpath(__DIR__. '/../../fixture/Modules');
    }

    public function testGetAllModules()
    {
        $this->assertTrue(is_array($modules = $this->repository->all()));
        $this->assertEquals($this->repository->count(), 2);
    }

    public function testGetCachedModules()
    {
        $this->assertTrue(is_array($modules = $this->repository->getCached()));
        $this->assertEquals($this->repository->count(), 2);
    }

    public function testGetOrdered()
    {
        $this->assertTrue(is_array($modules = $this->repository->getOrdered()));
        $this->assertEquals($this->repository->count(), 2);
    }

    public function testGetConfig()
    {
        $this->repository->config('assets');
        $this->repository->config('modules');
        $this->repository->config('migration');
        $this->repository->getAssetsPath();
    }

    public function testGetAndSetModuleStatus()
    {
        $status = $this->repository->active('user');
        $this->assertTrue($status);

        $this->repository->disable('user');

        $status = $this->repository->active('user');
        $this->assertFalse($status);

        $this->repository->enable('user');
    }

    public function testUsed()
    {
        $this->repository->setUsed('user');
        $used = $this->repository->getUsed();
        $this->assertEquals('user', $used->getLowerName());
    }

    public function testAddPath()
    {
        $this->repository->addLocation(__DIR__ . '/../../../fixture/app/modules');
        $this->repository->addPath(__DIR__ . '/../../../fixture/vendor');
        $this->assertEquals(2, count($this->repository->getPaths()));
    }

    public function testInstallAndUpdateModule()
    {
        $this->repository->install('pingpongcms/core');
    }

}