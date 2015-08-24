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

use Naucon\Utility\IteratorAbstract;
use Naucon\Utility\Exception\IteratorReverseException;

/**
 * Abstract Reverse Iterator Class
 *
 * @abstract
 * @package       Utility
 * @author        Sven Sanzenbacher
 */
abstract class IteratorReverseAbstract extends IteratorAbstract
{
    /**
     * count item position
     * used as kind of pointer
     *
     * @access        protected
     * @var        int                       current item position
     */
    protected $_itemPosition = null;


    /**
     * @return        bool                    current item is first
     */
    public function isFirst()
    {
        if ($this->getItemPosition() == 0) {
            return true;
        }
        return false;
    }

    /**
     * @return        bool                    current item is last
     */
    public function isLast()
    {
        if ($this->getItemPosition() == ($this->countItems() - 1)) {
            return true;
        }
        return false;
    }

    /**
     * return the current item
     *
     * @return        mixed                    current item
     */
    public function current()
    {
        if (is_null($this->_itemPosition)) {
            $this->rewind();
        }

        return current($this->_items);
    }

    /**
     * set next item to current item
     *
     * @return        void
     */
    public function next()
    {
        $this->_itemValid = true;

        if (!prev($this->_items)) {
            // no next item
            $this->_itemValid = false;
        } else {
            $this->_itemPosition--;
        }
    }

    /**
     * return true if iterator has a next items
     *
     * @return        bool                has next item
     */
    public function hasNext()
    {
        if ($this->getItemPosition() > 0) {
            return true;
        }
        return false;
    }

    /**
     * set previous item as current item
     *
     * @return        void
     */
    public function previous()
    {
        $this->_itemValid = true;

        if (!next($this->_items)) {
            $this->_itemValid = false;
        } else {
            $this->_itemPosition++;
        }
    }

    /**
     * return true if iterator has a previous items
     *
     * @return        bool            has previous item
     */
    public function hasPrevious()
    {
        if ($this->getItemPosition() < ($this->countItems() - 1)) {
            return true;
        }
        return false;
    }

    /**
     * set first item as current item
     *
     * @return        void
     */
    public function first()
    {
        $this->rewind();
    }

    /**
     * set last item as current item
     *
     * @return        void
     */
    public function last()
    {
        // reset item position
        $this->_itemPosition = 0;

        // reset internal pointer
        reset($this->_items);

        if ($this->countItems() > 0) {
            $this->_itemValid = true;
        } else {
            $this->_itemValid = false;
        }
    }

    /**
     * return index of the current item
     *
     * @return        mixed                index of current item
     */
    public function key()
    {
        if (is_null($this->_itemPosition)) {
            $this->rewind();
        }

        return key($this->_items);
    }

    /**
     * rewind to the first item
     *
     * @return        void
     */
    public function rewind()
    {
        $this->_itemValid = true;

        if (!end($this->_items)) {
            $this->_itemValid = false;
        } else {
            if (($countItems = $this->countItems()) > 0) {
                $this->_itemPosition = $countItems - 1;
            } else {
                $this->_itemPosition = 0;
            }
        }
    }

    /**
     * set item of specified position to current item
     *
     * @param        int                    item position
     * @return        void
     */
    public function setItemPosition($position)
    {
        if ((int)$position >= 0) {
            // check if given position is larger as possible position
            if ($position >= ($countItems = $this->countItems())) {
                // set position to max possible position
                $position = $countItems - 1;
            }

            if ($position <= ($this->countItems() / 2)) {
                reset($this->_items);
                if (($countItems = $this->countItems()) > 0) {
                    $this->_itemValid = true;
                    $this->_itemPosition = $countItems - 1;
                } else {
                    $this->_itemValid = false;
                    $this->_itemPosition = 0;
                }

                // go with next
                while ($position != $this->_itemPosition) {
                    if (!next($this->_items)) {
                        $this->_itemValid = false;
                        throw new IteratorReverseException('Specified position is not valid (next).', E_NOTICE);
                        break;
                    } else {
                        $this->_itemValid = true;
                        $this->_itemPosition--;
                    }
                }
            } else {
                if (!end($this->_items)) {
                    $this->_itemValid = false;
                    $this->_itemPosition = 0;
                } else {
                    $this->_itemValid = true;
                    $this->_itemPosition = 0;
                }

                // go with prev
                while ($position != $this->_itemPosition) {
                    if (!prev($this->_items)) {
                        $this->_itemValid = false;
                        throw new IteratorReverseException('Specified position is not valid (previous).', E_NOTICE);
                        break;
                    } else {
                        $this->_itemValid = true;
                        $this->_itemPosition++;
                    }
                }
            }
        } else {
            throw new IteratorReverseException('Specified position is not valid.', E_WARNING);
        }
    }
}