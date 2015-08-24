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

use Naucon\Utility\ListInterface;
use Naucon\Utility\CollectionAbstract;
use Naucon\Utility\Exception\ListException;

/**
 * Abstract List Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example ListExample.php
 */
abstract class ListAbstract extends CollectionAbstract implements ListInterface
{
    /**
     * add a element to the end of the list
     *
     * @param    mixed            element
     * @return    void
     */
    public function add($element)
    {
        parent::add($element);
    }

    /**
     * add a element to a specified position of the list
     *
     * @param    int                element index
     * @param    mixed            element
     * @return    void
     */
    public function addWithIndex($index, $element)
    {
        if (!is_null($index)
            && is_scalar($index)
        ) {
            if (!$this->hasIndex($index)) {
                $this->set($index, $element);
            } else {
                // index already exist
                throw new ListException('Element could not be added to list. Index already exist.', E_NOTICE);
            }
        } else {
            // given index name is not valid
            throw new ListException('Element could not be added to list. Index is not valid.', E_NOTICE);
        }
    }

    /**
     * return the element of a specified position in the list
     *
     * @param    int                index
     * @return    mixed            element of the specified position
     */
    public function get($index)
    {
        if ($this->hasIndex($index)) {
            return $this->_items[$index];
        }
        return null;
    }

    /**
     * return true if iterator contains a specified index.
     *
     * @param    mixed        index
     * @return    bool        has index
     */
    public function hasIndex($index)
    {
        if (array_key_exists($index, $this->_items)) {
            return true;
        }
        return false;
    }

    /**
     * remove element with specified position from list
     *
     * @param    int                element index
     * @return    bool
     */
    public function removeIndex($index)
    {
        if ($this->hasIndex($index)) {
            unset($this->_items[$index]);
            $this->_iterator = null;
            return true;
        }
        return false;
    }

    /**
     * add or replace a element to a specified position of the list
     *
     * @param    int                element index
     * @param    mixed            element
     * @return    mixed            element
     */
    public function set($index, $element)
    {
        if (!is_null($index)
            && is_scalar($index)
        ) {
            $this->_iterator = null;
            return $this->_items[$index] = $element;
        } else {
            // given index name is not valid
            throw new ListException('Element could not be added to list. Index is not valid.', E_NOTICE);
        }
    }
}