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

use Naucon\Utility\Exception\HashMapException;

/**
 * Abstract Hash Map Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class HashMapAbstract extends MapAbstract implements HashMapInterface
{
    /**
     * @access   protected
     * @param    mixed      $key        map key
     * @return   string                 hash key
     */
    protected function keyHash($key)
    {
        if (is_object($key)) {
            // can't use spl_object_hash because it returns the same hash for every object of the same class
            $hash = md5(spl_object_hash($key));
        } else {
            $hash = md5((string)$key);
        }
        return $hash;
    }

    /**
     * map contains key
     *
     * @param    mixed      $key        map key
     * @return   bool
     */
    public function hasKey($key)
    {
        $hash = $this->keyHash($key);
        return $this->hasIndex($hash);
    }

    /**
     * get map value
     *
     * @param    mixed      $key        map key
     * @return   mixed                  map value
     */
    public function get($key)
    {
        $hash = $this->keyHash($key);

        return parent::get($hash);
    }

    /**
     * set map value
     *
     * @param    mixed      $key        map key
     * @param    mixed      $value      map value
     * @return   mixed                  map value
     * @throws   HashMapException
     */
    public function set($key, $value)
    {
        if (!is_null($key)) {
            $hash = $this->keyHash($key);
            return parent::set($hash, $value);
        } else {
            throw new HashMapException('try to set mapping without key.', E_WARNING);
        }
    }

    /**
     * remove mapping
     *
     * @param    mixed      $key        map key
     * @return   mixed                  map value
     */
    public function remove($key)
    {
        $hash = $this->keyHash($key);

        return parent::remove($hash);
    }
}