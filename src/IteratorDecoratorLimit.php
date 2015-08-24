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

use Naucon\Utility\IteratorDecoratorAbstract;
use Naucon\Utility\Exception\IteratorDecoratorLimitException;

/**
 * Limit Iterator Decorator Class
 * limited subset of items
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class IteratorDecoratorLimit extends IteratorDecoratorAbstract
{
    /**
     * @access    protected
     * @var    int
     */
    protected $_itemOffset = 0;

    /**
     * @access    protected
     * @var    int
     */
    protected $_itemCount = 50;


    /**
     * Constructor
     *
     * @param    IteratorInterface        iterator object
     * @param    int                        item offset
     * @param    int                        item count
     */
    public function __construct(IteratorInterface $iteratorObject, $offset = 0, $count = 50)
    {
        parent::__construct($iteratorObject);

        $this->setItemOffset($offset);
        $this->setItemCount($count);
    }


    /**
     * @return    int        item offset
     */
    public function getItemOffset()
    {
        return $this->_itemOffset;
    }

    /**
     * @param    int        item offset
     * @return    void
     */
    public function setItemOffset($offset)
    {
        if ((int)$offset >= 0) {
            $this->_itemOffset = (int)$offset;
        } else {
            throw new IteratorDecoratorLimitException('Invalid offset given.', E_WARNING);
        }
    }

    /**
     * @return    int        item count
     */
    public function getItemCount()
    {
        return $this->_itemCount;
    }

    /**
     * @param    int        item count
     * @return    void
     */
    public function setItemCount($count)
    {
        if ((int)$count > 0) {
            $this->_itemCount = (int)$count;
        } else {
            throw new IteratorDecoratorLimitException('Invalid count given.', E_WARNING);
        }
    }

    /**
     * return true if iterator has a next items
     *
     * @return    bool            has next item
     */
    public function hasNext()
    {
        if (parent::hasNext()
            && ($this->getItemPosition() < ($this->getItemOffset() + $this->getItemCount()) - 1)
        ) {
            return true;
        }
        return false;
    }

    /**
     * return true if iterator has a previous items
     *
     * @return    bool        has previous item
     */
    public function hasPrevious()
    {
        if (parent::hasPrevious()
            && ($this->getItemPosition() >= $this->getItemOffset())
        ) {
            return true;
        }
        return false;
    }

    /**
     * return true if current item is valid
     *
     * @return    bool            current item is valid
     */
    public function valid()
    {
        if ($this->getItemPosition() >= $this->getItemOffset()
            && $this->getItemPosition() < ($this->getItemOffset() + $this->getItemCount())
        ) {
            return parent::valid();
        }
        return false;
    }

    /**
     * rewind to the first item
     *
     * @return    void
     */
    public function rewind()
    {
        parent::rewind();

        if ($this->getItemOffset() > 0) {
            $this->setItemPosition($this->getItemOffset());
        }
    }

    /**
     * set first item as current item
     *
     * @return    void
     */
    public function first()
    {
        $this->rewind();
    }

    /**
     * set last item as current item
     *
     * @return    void
     */
    public function last()
    {
        $this->setItemPosition(($this->getItemOffset() + $this->getItemCount()) - 1);
    }

    /**
     * return the number of items in the subset
     *
     * @return    int            number of items
     */
    public function count()
    {
        $countItems = $this->countItems() - $this->getItemOffset();
        if ($countItems >= $this->getItemCount()) {
            $countItems = $this->getItemCount();
        }
        return $countItems;
    }
}