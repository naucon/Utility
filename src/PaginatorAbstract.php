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

use Naucon\Utility\IteratorLimit;
use Naucon\Utility\PaginatorInterface;
use Naucon\Utility\Exception\PaginatorException;

/**
 * Abstract Paginator Class
 * Pagination process of deviding entries into pages
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class PaginatorAbstract extends IteratorLimitAbstract implements PaginatorInterface
{
    /**
     * @access    protected
     * @var       int                    current page number
     */
    protected $_currentPageNumber = 1;


    /**
     * @access    protected
     * @return    void
     */
    protected function buildItemOffset()
    {
        $this->_itemOffset = ($this->getCurrentPageNumber() > 1) ? (($this->getCurrentPageNumber() - 1) * $this->getItemCount()) : 0;
    }

    /**
     * @param    int        item count
     * @return   void
     */
    public function setItemCount($count)
    {
        parent::setItemCount($count);
        $this->buildItemOffset();
    }

    /**
     * @return    int                current page number
     */
    public function getCurrentPageNumber()
    {
        return $this->_currentPageNumber;
    }

    /**
     * @param    int                current page number
     * @return   void
     */
    public function setCurrentPageNumber($pageNumber)
    {
        if ($pageNumber >= 1) {
            $this->_currentPageNumber = (int)$pageNumber;
            $this->buildItemOffset();
        }
    }

    /**
     * @param    int                current page number
     * @return   void
     * @see      PaginatorAbstract::setCurrentPageNumber()
     */
    public function setPage($pageNumber)
    {
        $this->setCurrentPageNumber($pageNumber);
    }

    /**
     * @return    int                page number
     */
    public function nextPage()
    {
        if ($this->hasNextPage()) {
            $this->_currentPageNumber++;
            $this->buildItemOffset();
        }
        return $this->_currentPageNumber;
    }

    /**
     * @return    int                page number
     */
    public function previousPage()
    {
        if ($this->hasPreviousPage()) {
            $this->_currentPageNumber--;
            $this->buildItemOffset();
        }
        return $this->_currentPageNumber;
    }

    /**
     * @return    int                number of items per page
     */
    public function getItemsPerPage()
    {
        return $this->getItemCount();
    }

    /**
     * @param    int                number of items per page
     * @return   void
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->setItemCount($itemsPerPage);
    }

    /**
     * @return    int                amount of pages
     */
    public function countPages()
    {
        if ($this->getItemsPerPage() > 0) {
            return ceil($this->countItems() / $this->getItemsPerPage());
        } else {
            return 0;
        }
    }

    /**
     * @return    bool        current page is the first page
     */
    public function isFirstPage()
    {
        if ($this->getCurrentPageNumber() == 1) {
            return true;
        }
        return false;
    }

    /**
     * @return    bool        current page is the last page
     */
    public function isLastPage()
    {
        if ($this->getCurrentPageNumber() == $this->countPages()) {
            return true;
        }
        return false;
    }

    /**
     * @return    bool        has a next page
     */
    public function hasNextPage()
    {
        if (!$this->isLastPage()) {
            return true;
        }
        return false;
    }

    /**
     * @return    int            next page number or 0
     */
    public function getNextPageNumber()
    {
        if ($this->hasNextPage()) {
            return $this->getCurrentPageNumber() + 1;
        }
        return 0;
    }

    /**
     * @return    bool        has a previous page
     */
    public function hasPreviousPage()
    {
        if (!$this->isFirstPage()) {
            return true;
        }
        return false;
    }

    /**
     * @return    int            previous page number or 0
     */
    public function getPreviousPageNumber()
    {
        if ($this->hasPreviousPage()) {
            return $this->getCurrentPageNumber() - 1;
        }
        return 0;
    }
}