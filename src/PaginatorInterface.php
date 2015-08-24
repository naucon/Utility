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
 * Paginator Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface PaginatorInterface
{
    /**
     * @return   int                current page number
     */
    public function getCurrentPageNumber();

    /**
     * @param    int                current page number
     * @return   void
     */
    public function setCurrentPageNumber($pageNumber);

    /**
     * @param    int                current page number
     * @return   void
     * @see      PaginatorAbstract::setCurrentPageNumber()
     */
    public function setPage($pageNumber);

    /**
     * @return    int                page number
     */
    public function nextPage();

    /**
     * @return    int                page number
     */
    public function previousPage();

    /**
     * @return    int                number of items per page
     */
    public function getItemsPerPage();

    /**
     * @param    int                number of items per page
     * @return   void
     */
    public function setItemsPerPage($itemsPerPage);

    /**
     * @return    int                amount of pages
     */
    public function countPages();

    /**
     * @return    bool        current page is the first page
     */
    public function isFirstPage();

    /**
     * @return    bool        current page is the last page
     */
    public function isLastPage();

    /**
     * @return    bool        has a next page
     */
    public function hasNextPage();

    /**
     * @return    int            next page number or 0
     */
    public function getNextPageNumber();

    /**
     * @return    bool        has a previous page
     */
    public function hasPreviousPage();

    /**
     * @return    int            previous page number or 0
     */
    public function getPreviousPageNumber();
}