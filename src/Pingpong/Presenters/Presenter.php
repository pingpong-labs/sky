<?php

namespace Pingpong\Presenters;

abstract class Presenter
{
    /**
     * The entity instance.
     *
     * @var PresentableInterface
     */
    protected $entity;

    /**
     * The constructor.
     *
     * @param PresentableInterface $entity
     */
    public function __construct(PresentableInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity class.
     *
     * @return PresentableInterface
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Handle call to __get method.
     *
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return call_user_func(array($this, $key));
        }

        return $this->entity->{$key};
    }
}
