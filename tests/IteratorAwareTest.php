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

use Naucon\Utility\IteratorAware;
use Naucon\Utility\Iterator;

class IteratorAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    IteratorAware
     */
    public function testInit()
    {
        $iteratorAwareObject = new IteratorAware(new Iterator(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10)));
        return $iteratorAwareObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorAware       $iteratorAwareObject
     * @return   void
     */
    public function testCount(IteratorAware $iteratorAwareObject)
    {
        $this->assertEquals(10, count($iteratorAwareObject));
    }

    /**
     * @depends  testInit
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testCurrent(IteratorAware $iteratorAwareObject)
    {
        $this->assertEquals(1, $iteratorAwareObject->getIterator()->current());
        return $iteratorAwareObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testNext(IteratorAware $iteratorAwareObject)
    {
        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(2, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(3, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(4, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(5, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(6, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(7, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(8, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(9, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasNext());

        $iteratorAwareObject->getIterator()->next();
        $this->assertEquals(10, $iteratorAwareObject->getIterator()->current());

        $this->assertFalse($iteratorAwareObject->getIterator()->hasNext());

        return $iteratorAwareObject;
    }

    /**
     * @depends testNext
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testPrevious(IteratorAware $iteratorAwareObject)
    {
        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(9, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(8, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(7, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(6, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(5, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(4, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(3, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(2, $iteratorAwareObject->getIterator()->current());

        $this->assertTrue($iteratorAwareObject->getIterator()->hasPrevious());

        $iteratorAwareObject->getIterator()->previous();
        $this->assertEquals(1, $iteratorAwareObject->getIterator()->current());

        $this->assertFalse($iteratorAwareObject->getIterator()->hasPrevious());

        return $iteratorAwareObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testLast(IteratorAware $iteratorAwareObject)
    {
        $iteratorAwareObject->getIterator()->last();

        $this->assertEquals(10, $iteratorAwareObject->getIterator()->current());

        return $iteratorAwareObject;
    }

    /**
     * @depends  testLast
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testFirst(IteratorAware $iteratorAwareObject)
    {
        $iteratorAwareObject->getIterator()->first();

        $this->assertEquals(1, $iteratorAwareObject->getIterator()->current());

        return $iteratorAwareObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testIteration(IteratorAware $iteratorAwareObject)
    {
        $array = array();
        foreach ($iteratorAwareObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));
        $this->assertEquals(1, $array[0]);
        $this->assertEquals(2, $array[1]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(4, $array[3]);
        $this->assertEquals(5, $array[4]);
        $this->assertEquals(6, $array[5]);
        $this->assertEquals(7, $array[6]);
        $this->assertEquals(8, $array[7]);
        $this->assertEquals(9, $array[8]);
        $this->assertEquals(10, $array[9]);

        return $iteratorAwareObject;
    }

    /**
     * @depends  testFirst
     * @param    IteratorAware       $iteratorAwareObject
     * @return   IteratorAware
     */
    public function testSetPosition(IteratorAware $iteratorAwareObject)
    {
        $iteratorAwareObject->getIterator()->setItemPosition(2);
        $this->assertEquals(2, $iteratorAwareObject->getIterator()->getItemPosition());
        $this->assertEquals(3, $iteratorAwareObject->getIterator()->current());

        $iteratorAwareObject->getIterator()->setItemPosition(9);
        $this->assertEquals(9, $iteratorAwareObject->getIterator()->getItemPosition());
        $this->assertEquals(10, $iteratorAwareObject->getIterator()->current());

        $iteratorAwareObject->getIterator()->setItemPosition(0);
        $this->assertEquals(0, $iteratorAwareObject->getIterator()->getItemPosition());
        $this->assertEquals(1, $iteratorAwareObject->getIterator()->current());

        $iteratorAwareObject->getIterator()->setItemPosition(6);
        $this->assertEquals(6, $iteratorAwareObject->getIterator()->getItemPosition());
        $this->assertEquals(7, $iteratorAwareObject->getIterator()->current());

        $iteratorAwareObject->getIterator()->setItemPosition(4);
        $this->assertEquals(4, $iteratorAwareObject->getIterator()->getItemPosition());
        $this->assertEquals(5, $iteratorAwareObject->getIterator()->current());

        return $iteratorAwareObject;
    }
}