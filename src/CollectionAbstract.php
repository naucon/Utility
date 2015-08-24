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

use Naucon\Utility\Iterable;
use Naucon\Utility\Iterator;
use Naucon\Utility\CollectionInterface;
use Naucon\Utility\Exception\CollectionException;

/**
 * Abstract Collection Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class CollectionAbstract extends IterableAbstract implements CollectionInterface
{
    /**
     * contains all items of the collection
     *
     * @access    protected
     * @var    array                items
     */
    protected $_items = array();


    /**
     * add a element to the end of the collection
     *
     * @param    mixed            element
     * @return    void
     */
    public function add($element)
    {
        $this->_items[] = $element;
        $this->_iterator = null;
    }

    /**
     * add elements to the end of the collection
     *
     * @param    array            elements
     * @return    void
     */
    public function addAll(array $elements)
    {
        if (is_array($elements)) {
            foreach ($elements as $element) {
                $this->_items[] = $element;
            }
            $this->_iterator = null;
        } else {
            throw new CollectionException('Given array can not added to collection, because it is no array.', E_NOTICE);
        }
    }

    /**
     * @return    void
     */
    public function clear()
    {
        $this->_items = array();
        $this->_itemPosition = 0;
        $this->_itemValid = false;
    }

    /**
     * collection contains a given element
     *
     * @param    mixed            element
     * @return    bool            true if the collection contains a specified element
     */
    public function contains($element)
    {
        if ($this->indexOf($element) !== false) {
            return true;
        }
        return false;
    }

    /**
     * return true if the collection is empty
     *
     * @return    bool            true if the collection is empty
     */
    public function isEmpty()
    {
        return (count($this->_items) > 0) ? false : true;
    }

    /**
     * return a iterator
     *
     * @return    IteratorInterface
     */
    public function getIterator()
    {
        if (is_null($this->_iterator)) {
            $this->_iterator = new Iterator($this->_items);
        }
        return $this->_iterator;
    }

    /**
     * @access    protected
     * @param    mixed            element
     * @return    mixed            index of element or false if not exist
     */
    protected function indexOf($element)
    {
        return array_search($element, $this->_items);
    }

    /**
     * remove a specified element from the collection
     *
     * @param    mixed            element
     * @return    bool
     */
    public function remove($element)
    {
        $index = $this->indexOf($element);

        if ($index !== false) {
            unset($this->_items[$index]);
            $this->_items = array_values($this->_items);
            $this->_iterator = null;
            return true;
        }
        return false;
    }

    /**
     * return the number of items
     *
     * @return    int                number of items
     */
    public function count()
    {
        return count($this->_items);
    }

    /**
     * return a array with all elements
     *
     * @return    array
     */
    public function toArray()
    {
        return $this->_items;
    }
}