<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility\Tests;

use Naucon\Utility\Paginator;
use Naucon\Utility\PaginatorAbstract;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    PaginatorAbstract
     */
    public function testInit()
    {
        $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

        $paginatorObject = new Paginator($array, 10);
        return $paginatorObject;
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   void
     */
    public function testCount(PaginatorAbstract $paginatorObject)
    {
        $this->assertEquals(10, count($paginatorObject));
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testCurrent(PaginatorAbstract $paginatorObject)
    {
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testCurrent
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNext(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->next(); // 2
        $this->assertEquals(2, $paginatorObject->current());
        $paginatorObject->next(); // 3
        $this->assertEquals(3, $paginatorObject->current());
        $paginatorObject->next(); // 4
        $this->assertEquals(4, $paginatorObject->current());
        $paginatorObject->next(); // 5
        $this->assertEquals(5, $paginatorObject->current());
        $paginatorObject->next(); // 6
        $this->assertEquals(6, $paginatorObject->current());
        $paginatorObject->next(); // 7
        $this->assertEquals(7, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNext
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPrev(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->previous(); // 6
        $this->assertEquals(6, $paginatorObject->current());
        $paginatorObject->previous(); // 5
        $this->assertEquals(5, $paginatorObject->current());
        $paginatorObject->previous(); // 4
        $this->assertEquals(4, $paginatorObject->current());
        $paginatorObject->previous(); // 3
        $this->assertEquals(3, $paginatorObject->current());
        $paginatorObject->previous(); // 2
        $this->assertEquals(2, $paginatorObject->current());
        $paginatorObject->previous(); // 1
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testPrev
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testLast(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->last();
        $this->assertEquals(10, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testLast
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testFirst(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->first();
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   void
     */
    public function testCountPage(PaginatorAbstract $paginatorObject)
    {
        $this->assertEquals(3, $paginatorObject->countPages());
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   void
     */
    public function testIteration(PaginatorAbstract $paginatorObject)
    {
        $array = array();
        foreach ($paginatorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));

        $this->assertEquals(1, $array[0]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(5, $array[4]);
        $this->assertEquals(8, $array[7]);
        $this->assertEquals(10, $array[9]);
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPage(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->nextPage();

        $array = array();
        foreach ($paginatorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));

        $this->assertEquals(11, $array[0]);
        $this->assertEquals(13, $array[2]);
        $this->assertEquals(15, $array[4]);
        $this->assertEquals(18, $array[7]);
        $this->assertEquals(20, $array[9]);

        return $paginatorObject;
    }

    /**
     * @depends  testNextPage
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPageCurrent(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->rewind();
        $this->assertEquals(11, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNextPageCurrent
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPageNext(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->next(); // 12
        $this->assertEquals(12, $paginatorObject->current());
        $paginatorObject->next(); // 13
        $this->assertEquals(13, $paginatorObject->current());
        $paginatorObject->next(); // 14
        $this->assertEquals(14, $paginatorObject->current());
        $paginatorObject->next(); // 15
        $this->assertEquals(15, $paginatorObject->current());
        $paginatorObject->next(); // 16
        $this->assertEquals(16, $paginatorObject->current());
        $paginatorObject->next(); // 17
        $this->assertEquals(17, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNextPageNext
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPagePrev(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->previous(); // 16
        $this->assertEquals(16, $paginatorObject->current());
        $paginatorObject->previous(); // 15
        $this->assertEquals(15, $paginatorObject->current());
        $paginatorObject->previous(); // 14
        $this->assertEquals(14, $paginatorObject->current());
        $paginatorObject->previous(); // 13
        $this->assertEquals(13, $paginatorObject->current());
        $paginatorObject->previous(); // 12
        $this->assertEquals(12, $paginatorObject->current());
        $paginatorObject->previous(); // 11
        $this->assertEquals(11, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNextPagePrev
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPageLast(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->last();
        $this->assertEquals(20, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNextPageLast
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testNextPageFirst(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->first();
        $this->assertEquals(11, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testNextPage
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPage(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->previousPage();

        $array = array();
        foreach ($paginatorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));

        $this->assertEquals(1, $array[0]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(5, $array[4]);
        $this->assertEquals(8, $array[7]);
        $this->assertEquals(10, $array[9]);
        return $paginatorObject;
    }

    /**
     * @depends  testPreviousPage
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPageCurrent(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->rewind();
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testPreviousPageCurrent
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPageNext(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->next(); // 2
        $this->assertEquals(2, $paginatorObject->current());
        $paginatorObject->next(); // 3
        $this->assertEquals(3, $paginatorObject->current());
        $paginatorObject->next(); // 4
        $this->assertEquals(4, $paginatorObject->current());
        $paginatorObject->next(); // 5
        $this->assertEquals(5, $paginatorObject->current());
        $paginatorObject->next(); // 6
        $this->assertEquals(6, $paginatorObject->current());
        $paginatorObject->next(); // 7
        $this->assertEquals(7, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testPreviousPageNext
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPagePrev(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->previous(); // 6
        $this->assertEquals(6, $paginatorObject->current());
        $paginatorObject->previous(); // 5
        $this->assertEquals(5, $paginatorObject->current());
        $paginatorObject->previous(); // 4
        $this->assertEquals(4, $paginatorObject->current());
        $paginatorObject->previous(); // 3
        $this->assertEquals(3, $paginatorObject->current());
        $paginatorObject->previous(); // 2
        $this->assertEquals(2, $paginatorObject->current());
        $paginatorObject->previous(); // 1
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testPreviousPagePrev
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPageLast(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->last();
        $this->assertEquals(10, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testPreviousPageLast
     * @param    PaginatorAbstract
     * @return   PaginatorAbstract
     */
    public function testPreviousPageFirst(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->first();
        $this->assertEquals(1, $paginatorObject->current());
        return $paginatorObject;
    }

    /**
     * @depends  testInit
     * @param    PaginatorAbstract
     * @return   void
     */
    public function testSetPage(PaginatorAbstract $paginatorObject)
    {
        $paginatorObject->setPage(3);

        $array = array();
        foreach ($paginatorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(1, count($array));

        $this->assertEquals(21, $array[0]);
    }
}