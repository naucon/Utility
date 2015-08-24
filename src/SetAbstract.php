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
use Naucon\Utility\Exception\SetException;

/**
 * Abstract Set Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class SetAbstract extends CollectionAbstract
{
    /**
     * add a element to the end of the collection
     *
     * @param    mixed            element
     * @return   bool
     */
    public function add($element)
    {
        if (!$this->contains($element)) {
            $this->_items[] = $element;
            $this->_iterator = null;
            return true;
        } else {
            // index already exist
            return false;
        }
    }

    /**
     * add elements to the end of the collection
     *
     * @param    array            elements
     * @return   void
     */
    public function addAll(array $elements)
    {
        if (is_array($elements)) {
            foreach ($elements as $element) {
                $this->add($element);
            }
        }
    }
}