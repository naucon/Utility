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
 * Composite Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    CompositeExample.php
 */
abstract class CompositeAbstract extends IteratorAbstract implements CompositeElementInterface
{
    /**
     * @param    CompositeElementInterface         $compositeElementObject
     * @return   CompositeElementInterface
     */
    public function add(CompositeElementInterface $compositeElementObject)
    {
        $this->_items[] = $compositeElementObject;
    }

    /**
     * @param    CompositeElementInterface      $compositeElementObject
     * @return   bool
     */
    public function remove(CompositeElementInterface $compositeElementObject)
    {
        $index = $this->indexOf($compositeElementObject);

        if ($index !== false) {
            unset($this->_items[$index]);
            $this->_items = array_values($this->_items);
            return true;
        }
        return false;
    }
}