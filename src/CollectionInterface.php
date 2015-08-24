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

use Naucon\Utility\IterableInterface;

/**
 * Collection Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface CollectionInterface extends IterableInterface
{
    /**
     * add a element to the end of the collection
     *
     * @param    mixed            element
     * @return    void
     */
    public function add($element);

    /**
     * add elements to the end of the collection
     *
     * @param    array            elements
     * @return    void
     */
    public function addAll(array $elements);

    /**
     * remove all elements from collection
     *
     * @return    void
     */
    public function clear();

    /**
     * collection contains a given element
     *
     * @param    mixed            element
     * @return    bool            true if the collection contains a specified element
     */
    public function contains($element);

    /**
     * return true if the collection is empty
     *
     * @return    bool            true if the collection is empty
     */
    public function isEmpty();

    /**
     * remove a specified element from the collection
     *
     * @param    mixed            element
     * @return    bool
     */
    public function remove($element);

    /**
     * return a array with all elements
     *
     * @return    array
     */
    public function toArray();
}