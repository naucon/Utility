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

use Naucon\Utility\IterableInterface;
use Naucon\Utility\IteratorInterface;
use Naucon\Utility\Exception\IterableException;

/**
 * Iterable Abstract Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class IterableAbstract implements IterableInterface
{
    /**
     * @access    protected
     * @var    IteratorInterface
     */
    protected $_iterator = null;


    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->_iterator);
    }


    /**
     * return a iterator
     *
     * @return    IteratorInterface
     */
    public function getIterator()
    {
        if (!is_null($this->_iterator)) {
            return $this->_iterator;
        } else {
            throw new IterableException('Iterable has no Iterator.', E_ERROR);
        }
    }

    /**
     * return the number of items
     *
     * @return    int                number of items
     * @see IteratorInterface::count()
     */
    public function count()
    {
        return $this->getIterator()->count();
    }
}