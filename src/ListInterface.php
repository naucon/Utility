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
 * List Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface ListInterface extends CollectionInterface
{
    /**
     * add a element to a specified position of the list
     *
     * @param    int              element index
     * @param    mixed            element
     * @return   void
     */
    public function addWithIndex($index, $element);

    /**
     * return the element of a specified position in the list
     *
     * @param    int               element index
     * @return   mixed             element
     */
    public function get($index);

    /**
     * remove element with specified position from list
     *
     * @param    int                element index
     * @return   bool
     */
    public function removeIndex($index);

    /**
     * add or replace a element with index to a specified position of the list
     *
     * @param    int              element index
     * @param    mixed            element
     * @return   mixed            element
     */
    public function set($index, $element);
}