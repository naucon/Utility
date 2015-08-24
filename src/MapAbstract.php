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

use Naucon\Utility\MapInterface;
use Naucon\Utility\Exception\MapException;

/**
 * Abstract Map Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class MapAbstract implements MapInterface
{
    /**
     * @var array            map mappings
     */
    protected $_map = array();


    /**
     * @access    protected
     * @param     mixed        map key
     * @return    bool
     */
    protected function isValidKey($key)
    {
        if (is_string($key) || is_int($key)) {
            return true;
        }
        return false;
    }

    /**
     * @access    protected
     * @param     mixed        map value
     * @return    mixed        map key or false if not exist
     */
    protected function indexOf($value)
    {
        return array_search($value, $this->_map);
    }

    /**
     * map contains index
     *
     * @param    mixed        map index
     * @return   bool
     */
    protected function hasIndex($index)
    {
        if (array_key_exists($index, $this->_map)) {
            return true;
        }
        return false;
    }

    /**
     * map contains key
     *
     * @param    mixed        map key
     * @return   bool
     */
    public function hasKey($key)
    {
        return $this->hasIndex($key);
    }

    /**
     * map contains value
     *
     * @param    mixed        map value
     * @return   bool
     */
    public function hasValue($value)
    {
        if ($this->indexOf($value) !== false) {
            return true;
        }
        return false;
    }

    /**
     * get map value
     *
     * @param    mixed        map key
     * @return   mixed        map value
     */
    public function get($key)
    {
        if ($this->isValidKey($key)) {
            if ($this->hasIndex($key)) {
                return $this->_map[$key];
            }
        } else {
            throw new MapException('try to access with invalid map key.', E_NOTICE);
        }
        return null;
    }

    /**
     * get all mappings
     *
     * @return    array
     */
    public function getAll()
    {
        return $this->_map;
    }

    /**
     * set map value
     *
     * @param    mixed        map key
     * @param    mixed        map value
     * @return   mixed        map value
     */
    public function set($key, $value)
    {
        if (!is_null($key)) {
            if ($this->isValidKey($key)) {
                return $this->_map[$key] = $value;
            } else {
                throw new MapException('try to set with invalid map key.', E_NOTICE);
            }
        } else {
            throw new MapException('try to set mapping without key.', E_WARNING);
        }
    }

    /**
     * set all map key-value-pairs
     *
     * @param   array       map key-value-pairs
     * @return  void
     */
    public function setAll(array $all)
    {
        $this->_map = $all;
    }

    /**
     * remove mapping
     *
     * @param    mixed        map key
     * @return    mixed        map value
     */
    public function remove($key)
    {
        if ($this->isValidKey($key)) {
            if ($this->hasIndex($key)) {
                unset($this->_map[$key]);
                return true;
            }
        } else {
            throw new MapException('try to remove with invalid map key.', E_NOTICE);
        }
        return false;
    }

    /**
     * remove all mappings
     *
     * @return    void
     */
    public function clear()
    {
        $this->_map = array();
    }

    /**
     * count mappings
     *
     * @return    int
     */
    public function count()
    {
        return count($this->_map);
    }
}