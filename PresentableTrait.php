<?php

namespace Pingpong\Presenters;

use Illuminate\Container\Container;

trait PresentableTrait
{
    /**
     * The container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * Present the presenter object.
     *
     * @return object
     *
     * @throws \InvalidArgumentException
     */
    public function present()
    {
        if (is_null($this->presenter)) {
            throw new \InvalidArgumentException('Presenter is not defined.');
        }

        return $this->getContainer()->make($this->presenter, array($this));
    }

    /**
     * Set the presenter class.
     *
     * @param string $presenter
     *
     * @return $this
     */
    public function setPresenter($presenter)
    {
        $this->presenter = $presenter;

        return $this;
    }

    /**
     * Get presenter.
     *
     * @return string
     */
    public function getPresenter()
    {
        return $this->presenter;
    }

    /**
     * Set container instance.
     *
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get container instance.
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container ?: new Container();
    }
}
