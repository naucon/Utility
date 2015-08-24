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

use Naucon\Utility\IterableAbstract;

/**
 * Iterable Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class Iterable extends IterableAbstract
{
    /**
     * Constructor
     *
     * @param    IteratorInterface        iterator
     */
    public function __construct(IteratorInterface $iteratorObject = null)
    {
        $this->_iterator = $iteratorObject;
    }
}
