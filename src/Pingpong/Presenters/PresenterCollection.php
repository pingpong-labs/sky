<?php namespace Pingpong\Presenters;

use Countable;
use ArrayAccess;
use IteratorAggregate;
use Illuminate\Database\Eloquent\Collection;

class PresenterCollection implements Countable, ArrayAccess, IteratorAggregate
{
	/**
	 * @var  \Illuminate\Database\Eloquent\Collection  $collection
	 */
	protected $collection;

	/**
	 * Store new collection to the class.
	 *
	 * @param  string  $presenter
	 * @param  \Illuminate\Database\Eloquent\Collection  $collection
	 * @return void
	 */
	public function __construct($presenter, Collection $collection)
	{
		foreach ($collection as $key => $resource) {
			$collection->put($key, new $presenter($resource));
		}
		$this->collection = $collection;
	}

	/**
	 * Get count from the current collection.
	 *
	 * @return integer
	 */
	public function count()
	{
		return $this->collection->count();
	}

	/**
	 * Get current iterator.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getIterator()
	{
		return $this->collection;
	}

	/**
	 * Determine if the offset from current collection exists.
	 *
	 * @param  mixed   $offset
	 * @return integer
	 */
	public function offsetExists($offset)
	{
		return isset($this->collection[$offset]);
	}

	/**
	 * Get the specified collection by gived offset.
	 *
	 * @param  mixed   $offset
	 * @return integer
	 */
	public function offsetGet($offset)
	{
		return isset($this->collection[$offset])
			? $this->collection[$offset]
			: null
		;
	}

	/**
	 * Set new collection by gived value.
	 *
	 * @param  mixed   $offset
	 * @param  mixed   $value
	 * @return integer
	 */
	public function offsetSet($offset, $value)
	{
		return $this->collection[$offset] = $value;
	}

	/**
	 * Unset the specified collection from gived offset.
	 *
	 * @param  mixed   $offset
	 * @return integer
	 */
	public function offsetUnset($offset)
	{
		unset($this->collection[$offset]);
	}
}