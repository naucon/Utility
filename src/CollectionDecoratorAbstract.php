<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility;

use Naucon\Utility\CollectionInterface;

/**
 * Collection Decorator Abstract Class
 *
 * @abstract
 * @package 	Utility
 * @author		Sven Sanzenbacher
 */
abstract class CollectionDecoratorAbstract implements CollectionInterface
{
	/**
	 * @access	protected
	 * @var 	CollectionInterface
	 */
	protected $collectionObject = null;




	/**
	 * Constructor
	 *
	 * @param	CollectionInterface		collection object
	 */
	public function __construct( CollectionInterface $collectionObject )
	{
		$this->collectionObject = $collectionObject;
	}

	/**
	 * Destructor
	 */
	public function __destruct()
	{
		unset($this->collectionObject);
	}




	/**
	 * @access	protected
	 * @return	CollectionInterface		collection object
	 */
	protected function getCollectionObject()
	{
		return $this->collectionObject;
	}

	/**
	 * return a iterator
	 *
	 * @return	IteratorInterface
	 * @see CollectionInterface::getIterator()
	 */
	public function getIterator()
	{
		return $this->getCollectionObject()->getIterator();
	}

	/**
	 * add a element to the end of the collection
	 *
	 * @param	mixed			element
	 * @return	void
	 * @see CollectionInterface::add()
	 */
	public function add($element)
	{
	    return $this->getCollectionObject()->add($element);
	}

	/**
	 * add elements to the end of the collection
	 *
	 * @param	array			elements
	 * @return	void
	 * @see CollectionInterface::addAll()
	 */
	public function addAll( array $elements )
	{
	    return $this->getCollectionObject()->addAll($elements);
	}

	/**
	 * remove all elements from collection
	 *
	 * @return	void
	 * @see CollectionInterface::clear()
	 */
	public function clear()
	{
	    $this->getCollectionObject()->clear();
	}

	/**
	 * collection contains a given element
	 *
	 * @param	mixed			element
	 * @return	bool			true if the collection contains a specified element
	 * @see CollectionInterface::contains()
	 */
	public function contains($element)
	{
	    return $this->getCollectionObject()->contains($element);
	}

	/**
	 * return true if the collection is empty
	 *
	 * @return	bool			true if the collection is empty
	 * @see CollectionInterface::isEmpty()
	 */
	public function isEmpty()
	{
	    return $this->getCollectionObject()->isEmpty();
	}

	/**
	 * remove a specified element from the collection
	 *
	 * @param	mixed			element
	 * @return	bool
	 * @see CollectionInterface::remove()
	 */
	public function remove($element)
	{
	    return $this->getCollectionObject()->remove($element);
	}

	/**
	 * return a array with all elements
	 *
	 * @return	array
	 * @see CollectionInterface::toArray()
	 */
	public function toArray()
	{
	    return $this->getCollectionObject()->toArray();
	}

	/**
	 * return the number of items
	 *
	 * @return	int			number of items
	 * @see CollectionInterface::count()
	 */
	public function count()
	{
		return $this->getCollectionObject()->count();
	}
}