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
 * Iterator Limit Class
 * subset of items
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class IteratorLimit extends IteratorLimitAbstract
{
    /**
     * Constructor
     *
     * @param    array      $items      items
     * @param    int        $offset     item offset
     * @param    int        $count      item count
     */
    public function __construct(array $items = array(), $offset = 0, $count = 50)
    {
        $this->_items = $items;

        $this->setItemOffset($offset);
        $this->setItemCount($count);
    }
}