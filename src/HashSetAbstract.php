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

use Naucon\Utility\SetAbstract;
use Naucon\Utility\HashSetInterface;
use Naucon\Utility\Exception\HashSetException;

/**
 * Abstract Hash Set Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class HashSetAbstract extends SetAbstract implements HashSetInterface
{
    /**
     * add a element to the end of the collection
     *
     * @param    mixed            element
     * @return   bool
     */
    public function add($element)
    {
        if (!$this->contains($element)) {
            $hashIndex = $this->hashIndex($element);

            $this->_items[$hashIndex] = $element;
            $this->_iterator = null;
            return true;
        } else {
            // element already exist
            return false;
        }
    }

    /**
     * @access   protected
     * @param    mixed            element
     * @return   string           hash index
     */
    protected function hashIndex($element)
    {
        if (is_object($element)) {
            // can't use spl_object_hash because it returns the same hash for every object of the same class
            $hash = md5(spl_object_hash($element));
        } else {
            $hash = md5((string)$element);
        }
        return $hash;
    }

    /**
     * collection contains a given element
     *
     * @param    mixed            element
     * @return   bool             true if the hashset contains a specified element
     */
    public function contains($element)
    {
        $hashIndex = $this->hashIndex($element);

        if (array_key_exists($hashIndex, $this->_items)) {
            return true;
        }
        return false;
    }

    /**
     * remove a specified element from the collection
     *
     * @param    mixed            element
     * @return   bool
     */
    public function remove($element)
    {
        if ($this->contains($element)) {
            $hashIndex = $this->hashIndex($element);

            unset($this->_items[$hashIndex]);
            $this->_iterator = null;
            return true;
        }
        return false;
    }

    /**
     * return a array with all elements
     *
     * @return    array
     */
    public function toArray()
    {
        return array_values($this->_items);
    }
}