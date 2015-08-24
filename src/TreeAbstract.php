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

use Naucon\Utility\HashSet;
use Naucon\Utility\TreeInterface;
use Naucon\Utility\TreeNodeAbstract;
use Naucon\Utility\Exception\TreeException;

/**
 * Abstract Tree Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    TreeExample.php
 */
abstract class TreeAbstract extends TreeNodeAbstract implements TreeInterface
{
    /**
     * @access    protected
     * @var       IteratorInterface            child tree nodes
     */
    protected $_treeChildsObject = null;


    /**
     * @return    bool                        true = has one or more childs
     */
    public function hasChilds()
    {
        if (count($this->getChildsObject()) > 0) {
            return true;
        }
        return false;
    }

    /**
     * return a iterator
     *
     * @return    IteratorInterface
     */
    public function getIterator()
    {
        return $this->getChildsObject();
    }

    /**
     * return the number of items
     *
     * @return    int                number of items
     */
    public function count()
    {
        return $this->getChildsObject()->count();
    }

    /**
     * @access    protected
     * @return    IteratorInterface            child tree nodes
     */
    protected function getChildsObject()
    {
        if (is_null($this->_treeChildsObject)) {
            $this->_treeChildsObject = new HashSet();
        }
        return $this->_treeChildsObject;
    }

    /**
     * @access    protected
     * @return    IteratorInterface            child tree nodes
     * @see       TreeAbstract::getChildsObject()
     */
    protected function getChilds()
    {
        return $this->getChildsObject();
    }

    /**
     * @param     TreeNodeInterface            child tree node
     * @return    TreeNodeInterface            child tree node
     */
    public function add(TreeNodeInterface $childObject)
    {
        if ($childObject->hasParent()) {
            throw new TreeException('Tree node has already a parent. A tree node can only have 1 parent node.', E_ERROR);
        } else {
            $childObject->setParentObject($this);
            $this->getChildsObject()->add($childObject);
            return $childObject;
        }
    }

    /**
     * @param    TreeNodeInterface            child tree node
     * @return   void
     * @see      TreeInterface::add()
     */
    public function addChild(TreeNodeInterface $childObject)
    {
        $this->add($childObject);
    }

    /**
     * @param    TreeNodeInterface            child tree node
     * @return   void
     */
    public function remove(TreeNodeInterface $childObject)
    {
        $this->getChildsObject()->remove($childObject);

        $childObject->setParentObject(null);
    }

    /**
     * @param    TreeNodeInterface            child tree node
     * @return   void
     * @see      TreeInterface::remove()
     */
    public function removeChild(TreeNodeInterface $childObject)
    {
        $this->remove($childObject);
    }
}