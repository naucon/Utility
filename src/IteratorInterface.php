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

/**
 * Iterator Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * How the methodes are called from the foreach loops:
 * 1. Loop: rewind(), valid(), current(), key(), process in loop, next()
 * 2. Loop: valid(), current(), key(), process in loop, next()
 * 3. Loop: valid(), current(), key(), process in loop, next()
 * 4. Loop: valid() // no next item - valid returns fals
 */
interface IteratorInterface extends \Iterator, \Countable
{
    /**
     * @return    bool            current item is first
     */
    public function isFirst();

    /**
     * @return    bool            current item is last
     */
    public function isLast();

    /**
     * return true if iterator has a next items
     *
     * @return    bool            has next item
     */
    public function hasNext();

    /**
     * set previous item as current item
     *
     * @return    void
     */
    public function previous();

    /**
     * return true if iterator has a previous items
     *
     * @return    bool            has previous item
     */
    public function hasPrevious();

    /**
     * set first item as current item
     *
     * @return    void
     */
    public function first();

    /**
     * set last item as current item
     *
     * @return    void
     */
    public function last();

    /**
     * return true if iterator contains a specified index.
     *
     * @param    mixed        index
     * @return    bool        has index
     */
    public function hasIndex($index);

    /**
     * @param    mixed            element
     * @return    mixed            index of element or false if not exist
     */
    public function indexOf($element);

    /**
     * set item of specified position to current item
     *
     * @param    int                item position
     * @return    void
     */
    public function setItemPosition($position);

    /**
     * return the number of items
     * normaly the same as count(). But in subsets or paginator count() will return
     * the number of elements per page or limit while countItems() returns the total number of all items.
     *
     * @return    int                number of items
     * @see    IteratorInterface::count()
     */
    public function countItems();
}