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

use Naucon\Utility\IteratorAbstract;
use Naucon\Utility\EnumeratorInterface;
use Naucon\Utility\Exception\EnumeratorException;

/**
 * Abstract Enumerator Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class EnumeratorAbstract extends IteratorAbstract implements EnumeratorInterface
{
    /**
     * get value
     *
     * @param    mixed            key
     * @return   mixed            value
     */
    public function __get($key)
    {
        if ($this->hasIndex($key)) {
            return $this->_items[$key];
        } else {
            // no element found
            return null;
        }
    }

    /**
     * set key value pair
     *
     * @param    mixed            key
     * @param    mixed            value
     * @return   void
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * add or replace a value with a specified key
     *
     * @param    mixed            key
     * @param    mixed            value
     * @return   mixed            value
     */
    public function set($key, $value)
    {
        if (!is_null($key)
            && is_scalar($key)
        ) {
            return $this->_items[$key] = $value;
        } else {
            // given index name is not valid
            throw new EnumeratorException('Element could not be added to list. Index is not valid.', E_NOTICE);
        }
    }

    /**
     * @param    mixed            key
     * @return    bool
     */
    public function remove($key)
    {
        if ($this->hasIndex($key)) {
            unset($this->_items[$key]);
        }
    }
}