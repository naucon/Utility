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
 * Tree Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface TreeInterface extends TreeNodeInterface, IteratorAwareInterface
{
    /**
     * @param    TreeNodeInterface      $childObject        child tree node
     * @return   TreeNodeInterface            child tree node
     */
    public function add(TreeNodeInterface $childObject);

    /**
     * @param    TreeNodeInterface      $childObject        child tree node
     * @return   void
     */
    public function remove(TreeNodeInterface $childObject);

    /**
     * @return    bool                        true = has one or more childs
     */
    public function hasChilds();

    /**
     * @param    TreeNodeInterface      $childObject        child tree node
     * @return   TreeNodeInterface            child tree node
     * @see      TreeInterface::add()
     */
    public function addChild(TreeNodeInterface $childObject);

    /**
     * @param    TreeNodeInterface      $childObject        child tree node
     * @return   void
     * @see      TreeInterface::remove()
     */
    public function removeChild(TreeNodeInterface $childObject);
}