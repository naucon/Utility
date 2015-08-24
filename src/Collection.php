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

use Naucon\Utility\CollectionAbstract;

/**
 * Collection Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example CollectionExample.php
 */
class Collection extends CollectionAbstract
{
    /**
     * Constructor
     *
     * @param    array    item
     */
    public function __construct(array $items = array())
    {
        $this->_items = $items;
    }
}
