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

use Naucon\Utility\TreeInterface;

/**
 * Tree Node Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface TreeNodeInterface
{
    /**
     * @return    bool                    true = has a parent tree node
     */
    public function hasParent();

    /**
     * @return    TreeInterface            parent    tree node
     */
    public function getParentObject();

    /**
     * @return    TreeInterface            parent tree node
     * @see       TreeNodeInterface::getParentObject()
     */
    public function getParent();

    /**
     * @param    TreeInterface            parent tree node
     * @return   void
     */
    public function setParentObject(TreeInterface $parentObject = null);

    /**
     * @param    TreeInterface            parent tree node
     * @return   void
     * @see      TreeNodeInterface::setParentObject()
     */
    public function setParent(TreeInterface $parentObject = null);

    /**
     * @return    void
     */
    public function removeNode();
}