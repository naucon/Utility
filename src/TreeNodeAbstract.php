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

use Naucon\Utility\TreeNodeInterface;
use Naucon\Utility\TreeInterface;
use Naucon\Utility\Exception\TreeNodeException;

/**
 * Abstract Tree Node Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    TreeExample.php
 */
abstract class TreeNodeAbstract implements TreeNodeInterface
{
    /**
     * @access    protected
     * @var       TreeInterface                parent tree node
     */
    protected $_treeParentObject = null;


    /**
     * @return    bool                        true = has a parent
     */
    public function hasParent()
    {
        if (!is_null($this->getParentObject())) {
            return true;
        }
        return false;
    }

    /**
     * @return    TreeInterface                parent tree node
     */
    public function getParentObject()
    {
        return $this->_treeParentObject;
    }

    /**
     * @return    TreeInterface                parent tree node
     * @see       TreeAbstract::getParentObject()
     */
    public function getParent()
    {
        return $this->getParentObject();
    }

    /**
     * @param    TreeInterface                parent tree node
     * @return   void
     * @see      TreeNodeInterface::getChildObjects()
     */
    public function setParentObject(TreeInterface $parentObject = null)
    {
        $this->_treeParentObject = $parentObject;
    }

    /**
     * @param    TreeInterface                parent tree node
     * @return   void
     * @see      TreeNodeInterface::setParentObject()
     */
    public function setParent(TreeInterface $parentObject = null)
    {
        $this->setParentObject($parentObject);
    }

    /**
     * @return    void
     */
    public function removeNode()
    {
        if ($this->hasParent()) {
            $this->getParentObject()->removeChild($this);
            $this->_treeParentObject = null;
        } else {
            throw new TreeNodeException('Node has no parent. Befor node can be removed, it has to be child of a parent.');
        }
    }
}