<?php namespace Pingpong\Presenters;

abstract class Presenter {

    /**
     * @var PresentableInterface
     */
    protected $entity;

    /**
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
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key))
        {
            return call_user_func(array($this, $key));
        }

        return $this->entity->{$key};
    }

}