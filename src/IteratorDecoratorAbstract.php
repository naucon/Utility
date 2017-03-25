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

use Naucon\Utility\IteratorInterface;

/**
 * Iterator Decorator Abstract Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class IteratorDecoratorAbstract implements IteratorInterface
{
    /**
     * @access    protected
     * @var    IteratorInterface
     */
    protected $iteratorObject = null;


    /**
     * Constructor
     *
     * @param    IteratorInterface        iterator object
     */
    public function __construct(IteratorInterface $iteratorObject)
    {
        $this->iteratorObject = $iteratorObject;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->iteratorObject);
    }


    /**
     * @access    protected
     * @return    IteratorInterface        iterator object
     */
    protected function getIteratorObject()
    {
        return $this->iteratorObject;
    }

    /**
     * @access    protected
     * @param    IteratorInterface        iterator object
     * @return    void
     */
    protected function setIteratorObject(IteratorInterface $iteratorObject)
    {
        $this->iteratorObject = $iteratorObject;
    }

    /**
     * @return    int                current item position
     */
    public function getItemPosition()
    {
        return $this->getIteratorObject()->getItemPosition();
    }

    /**
     * @return    bool            current item is first
     */
    public function isFirst()
    {
        return $this->getIteratorObject()->isFirst();
    }

    /**
     * @return    bool            current item is last
     */
    public function isLast()
    {
        return $this->getIteratorObject()->isLast();
    }

    /**
     * return the current item
     *
     * @return    mixed            current item
     * @see        IteratorInterface::current()
     */
    public function current()
    {
        return $this->getIteratorObject()->current();
    }

    /**
     * set index of next item as current
     *
     * @return    void
     * @see        IteratorInterface::next()
     */
    public function next()
    {
        $this->getIteratorObject()->next();
    }

    /**
     * return true if iterator has a next items
     *
     * @return    bool            has next item
     * @see        IteratorInterface::hasNext()
     */
    public function hasNext()
    {
        return $this->getIteratorObject()->hasNext();
    }

    /**
     * set previous item as current item
     *
     * @return    void
     * @see        IteratorInterface::previous()
     */
    public function previous()
    {
        $this->getIteratorObject()->previous();
    }

    /**
     * return true if iterator has a previous items
     *
     * @return    bool        has previous item
     * @see        IteratorInterface::hasPrevious()
     */
    public function hasPrevious()
    {
        return $this->getIteratorObject()->hasPrevious();
    }

    /**
     * set first item as current item
     *
     * @return    void
     * @see        IteratorInterface::first()
     */
    public function first()
    {
        $this->getIteratorObject()->first();
    }

    /**
     * set last item as current item
     *
     * @return    void
     * @see        IteratorInterface::last()
     */
    public function last()
    {
        $this->getIteratorObject()->last();
    }

    /**
     * return index of the current item
     *
     * @return    mixed            index of current item
     * @see        IteratorInterface::key()
     */
    public function key()
    {
        return $this->getIteratorObject()->key();
    }

    /**
     * return true if current item is valid
     *
     * @return    bool            current item is valid
     * @see        IteratorInterface::valid()
     */
    public function valid()
    {
        return $this->getIteratorObject()->valid();
    }

    /**
     * rewind to the first item
     *
     * @return    void
     * @see        IteratorInterface::rewind()
     */
    public function rewind()
    {
        $this->getIteratorObject()->rewind();
    }

    /**
     * return true if iterator contains a specified index.
     *
     * @param    mixed        index
     * @return    bool        has index
     * @see        IteratorInterface::hasIndex()
     */
    public function hasIndex($index)
    {
        return $this->getIteratorObject()->hasIndex($index);
    }

    /**
     * @param    mixed            element
     * @return    mixed            index of element or false if not exist
     * @see        IteratorInterface::indexOf()
     */
    public function indexOf($element)
    {
        return $this->getIteratorObject()->indexOf($element);
    }

    /**
     * set item of specified position to current item
     *
     * @param    int                item position
     * @return    void
     * @see        IteratorInterface::setItemPosition()
     */
    public function setItemPosition($position)
    {
        $this->getIteratorObject()->setItemPosition($position);
    }

    /**
     * count items
     *
     * @return    int            number of items
     * @see        IteratorInterface::countItems()
     */
    public function countItems()
    {
        return $this->getIteratorObject()->countItems();
    }

    /**
     * return the number of items
     *
     * @return    int            number of items
     * @see     IteratorInterface::countItems()
     */
    public function count()
    {
        return $this->getIteratorObject()->count();
    }
}