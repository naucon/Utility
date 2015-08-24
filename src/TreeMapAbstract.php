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

use Naucon\Utility\Map;
use Naucon\Utility\MapInterface;
use Naucon\Utility\Exception\TreeMapException;

/**
 * Abstract Tree Map Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class TreeMapAbstract extends Map implements MapInterface
{
    /**
     * @access   protected
     * @param    mixed        map value
     * @return   mixed        map key or false if not exist
     */
    protected function indexOf($value)
    {
        return $this->searchArrayRecursive($value, $this->_map);
    }

    /**
     * @access   protected
     * @param    mixed        needle
     * @param    array        haystack
     * @param    bool         strict (typ save)
     * @return   mixed        key or false
     */
    protected function searchArrayRecursive($needle, array $haystack, $strict = false)
    {
        $return = false;
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $returnRecurisve = $this->searchArrayRecursive($needle, $value, $strict);

                if ($returnRecurisve !== false) {
                    if (is_array($returnRecurisve)) {
                        $return = array_merge(array($key), $returnRecurisve);
                    } else {
                        $return = array($key, $returnRecurisve);
                    }
                }
            } else {
                if ($strict) {
                    if ($needle === $value) {
                        $return = $key;
                        break;
                    }
                } else {
                    if ($needle == $value) {
                        $return = $key;
                        break;
                    }
                }
            }
        }
        return $return;
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
                if (count($this->_map[$key]) > 1) {
                    return $this->_map[$key];
                } elseif (count($this->_map[$key]) == 1) {
                    return $this->_map[$key][0];
                } else {
                    return null;
                }
            }
        } else {
            throw new TreeMapException('try to access with invalid map key.', E_NOTICE);
        }
        return null;
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
                return $this->_map[$key][] = $value;
            } else {
                throw new TreeMapException('try to set with invalid map key.', E_NOTICE);
            }
        } else {
            throw new TreeMapException('try to set mapping without key.', E_WARNING);
        }
    }

}