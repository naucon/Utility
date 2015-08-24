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
 * Map Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface MapInterface extends \Countable
{
    /**
     * map contains key
     *
     * @param    mixed        map key
     * @return    bool
     */
    public function hasKey($key);

    /**
     * map contains value
     *
     * @param    mixed        map value
     * @return    bool
     */
    public function hasValue($value);

    /**
     * get map value
     *
     * @param    mixed        map key
     * @return    mixed        map value
     */
    public function get($key);

    /**
     * get all mappings
     *
     * @return    array
     */
    public function getAll();

    /**
     * set map value
     *
     * @param    mixed        map key
     * @param    mixed        map value
     * @return    mixed        map value
     */
    public function set($key, $value);

    /**
     * set all map key-value-pairs
     *
     * @param   array       map key-value-pairs
     * @return  void
     */
    public function setAll(array $all);

    /**
     * remove mapping
     *
     * @param    mixed        map key
     * @return    mixed        map value
     */
    public function remove($key);

    /**
     * remove all mappings
     *
     * @return    void
     */
    public function clear();
}