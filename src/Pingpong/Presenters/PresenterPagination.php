<?php namespace Pingpong\Presenters;

use Countable;
use ArrayAccess;
use IteratorAggregate;
use Illuminate\Pagination\Paginator;

class PresenterPagination implements Countable, ArrayAccess, IteratorAggregate
{
	/**
	 * @var \Illuminate\Pagination\Paginator
	 */
	protected $paginator;

	/**
	 * Recreate new items to costum presenter.
	 *
	 * @param  string  $presenter
	 * @param  \Illuminate\Pagination\Paginator $paginator
	 * @return void
	 */
	public function __construct($presenter, Paginator $paginator)
	{
		$items = array();
		foreach ($paginator->getItems() as $key => $resource) {
			$items[$key] = new $presenter($resource);
		}
		$paginator->setItems($items);
		$this->paginator = $paginator;
	}

	/**
	 * Get count.
	 *
	 * @return integer
	 */
	public function count()
	{
		return $this->paginator->getTotal();
	}

	/**
	 * Determine if the offset from the items exists.
	 *
	 * @param  mixed   $offset
	 * @return integer
	 */
	public function offsetExists($offset)
	{
		return isset($this->paginator[$offset]);
	}

	/**
	 * Get the specified item by gived offset.
	 *
	 * @param  integer|mixed $offset
	 * @return mixed
	 */
	public function offsetGet($offset)
	{
		return isset($this->paginator[$offset])
			? $this->paginator[$offset]
			: null
		;
	}

	/**
	 * Set new item by gived value.
	 *
	 * @param  mixed   $offset
	 * @param  mixed   $value
	 * @return integer
	 */
	public function offsetSet($offset, $value)
	{
		return $this->paginator[$offset] = $value;
	}

	/**
	 * Unset the specified item from gived offset.
	 *
	 * @param  mixed   $offset
	 * @return integer
	 */
	public function offsetUnset($offset)
	{
		unset($this->paginator[$offset]);
	}

	/**
	 * Get current iterator.
	 *
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function getIterator()
	{
		return $this->paginator;
	}

	/**
	 * Magic call method.
	 * 
	 * @param  string $method
	 * @param  array  $args
	 * @return mixed
	 */
	public function __call($method, $args = array())
	{
		return call_user_func_array(array($this->paginator, $method), $args);
	}
}