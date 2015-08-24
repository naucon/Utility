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

use Naucon\Utility\Exception\ArrayPathException;

/**
 * Array Path Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    ArrayPathExample.php
 */
class ArrayPath
{
    /**
     * @var         array
     */
    protected $array = array();

    /**
     * @var         bool                    show path
     */
    protected $showPath = false;


    /**
     * Constructor
     *
     * @param       array                   any array
     */
    public function __construct(array $array = array())
    {
        $this->array = (is_array($array)) ? $array : array();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->array);
    }


    /**
     * @access      protected
     * @param       string                  delimiter eg. '.'
     * @param       string
     * @return      array
     */
    protected function explodePath($delimiter, $path)
    {
        $path = trim((string)$path);
        if (!empty($path)) {
            $array = explode((string)$delimiter, $path);
            if (is_array($array)) {
                return $array;
            }
        }
        return array();
    }

    /**
     * get a value by array path
     * the path string contains the keys of the interlaced array - glued by a point.
     * e.g. the path of the array $array['key1']['key2']['key3'] is 'key1.key2.key3'
     *
     * @param       string              array keys glued with a point
     * @return      mixed
     */
    public function get($path=null)
    {
        if ($this->getShowPath()) {
            return $path;
        } else {
            $value = $this->array;
            $pathArrays = $this->explodePath('.', $path);
            foreach ($pathArrays as $key) {
                if (!empty($key)
                    && is_array($value)
                    && array_key_exists($key, $value)
                ) {
                    $value = $value[$key];
                } else {
                    return null;
                }
            }
            return $value;
        }
    }

    /**
     * has a given array path
     * the path string contains the keys of the interlaced array - glued by a point.
     * e.g. the path of the array $array['key1']['key2']['key3'] is 'key1.key2.key3'
     *
     * @param       string              array keys glued with a point
     * @return      bool
     */
    public function has($path=null)
    {
        if (!is_null($this->get($path))) {
            return true;
        }
        return false;
    }

    /**
     * set a value by array path
     * the path string contains the keys of the interlaced array - glued by a point.
     * e.g. the path of the array $array['key1']['key2']['key3'] is 'key1.key2.key3'
     *
     * @param       string              array keys glued with a point
     * @param       mixed               value
     * @return      void
     */
    public function set($path, $value)
    {
        $this->array = $this->setAction($this->array, $path, $value);
    }

    /**
     * @access      protected
     * @param       array               array
     * @param       mixed               array keys in array or glued with a point in a string
     * @param       mixed               value
     * @return      array               new array
     */
    protected function setAction(array $array, $path, $value)
    {
        if (is_array($path)) {
            $pathArrays = $path;
        } else {
            if (is_null($path) || $path == '') {
                return $value;
            } else {
                $pathArrays = $this->explodePath('.', $path);
            }
        }

        if (is_array($array)
            && is_array($pathArrays)
            && count($pathArrays) > 0
        ) {
            $key = current($pathArrays);
            if (strlen($key) > 0) {
                if (count($pathArrays) > 1) {
                    if (!isset($array[$key])) { // not array_key_exists because we do not want unnecessary keys
                        $array[$key] = array();
                    }
                    unset($pathArrays[key($pathArrays)]);
                    $array[$key] = $this->setAction($array[$key], $pathArrays, $value);
                } else {
                    $array[$key] = $value;
                }
            }
            return $array;
        }
    }

    /**
     * set a array
     *
     * @param    array
     * @return    void
     */
    public function setAll(array $array)
    {
        $this->array = $array;
    }

    /**
     * delete a value by array path
     * the path string contains the keys of the interlaced array - glued by a point.
     * e.g. the path of the array $array['key1']['key2']['key3'] is 'key1.key2.key3'
     *
     * @param       string              array keys glued with a point
     * @return      void
     */
    public function del($path)
    {

        $this->array = $this->delAction($this->array, $path);
    }

    /**
     * @access      protected
     * @param       array               array
     * @param       string              array keys glued with a point
     * @return      array               new array
     */
    public function delAction(array $array, $path)
    {
        $pathArrays = $this->explodePath('.', $path);

        if (is_array($array)
            && is_array($pathArrays)
            && count($pathArrays) > 0
        ) {
            $key = current($pathArrays);
            if (!empty($key)
                && isset($array[$key]) // not array_key_exists because we do not want unnecessary keys
            ) {
                if (count($pathArrays) == 1) {
                    unset($array[$key]);
                } else {
                    unset($pathArrays[key($pathArrays)]);
                    $array[$key] = $this->delAction($array[$key], implode('.', $pathArrays));
                }
            }
            return $array;
        }
    }

    /**
     * @return      bool
     */
    public function getShowPath()
    {
        return $this->showPath;
    }

    /**
     * @param       bool                show path TRUE or FALSE
     * @return      void
     */
    public function setShowPath($value = false)
    {
        $this->showPath = ($value) ? true : false;
    }
}