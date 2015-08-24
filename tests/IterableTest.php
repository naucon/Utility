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

use Naucon\Utility\Iterable;
use Naucon\Utility\Iterator;

class IterableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    Iterable
     */
    public function testInit()
    {
        $iterableObject = new Iterable(new Iterator(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10)));
        return $iterableObject;
    }

    /**
     * @depends  testInit
     * @param    Iterable
     * @return   void
     */
    public function testCount(Iterable $iterableObject)
    {
        $this->assertEquals(10, count($iterableObject));
    }

    /**
     * @depends  testInit
     * @param    Iterable
     * @return   Iterable
     */
    public function testCurrent(Iterable $iterableObject)
    {
        $this->assertEquals(1, $iterableObject->getIterator()->current());
        return $iterableObject;
    }

    /**
     * @depends  testInit
     * @param    Iterable
     * @return   Iterable
     */
    public function testNext(Iterable $iterableObject)
    {
        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(2, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(3, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(4, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(5, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(6, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(7, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(8, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(9, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasNext());

        $iterableObject->getIterator()->next();
        $this->assertEquals(10, $iterableObject->getIterator()->current());

        $this->assertFalse($iterableObject->getIterator()->hasNext());

        return $iterableObject;
    }

    /**
     * @depends testNext
     * @param    Iterable
     * @return   Iterable
     */
    public function testPrevious(Iterable $iterableObject)
    {
        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(9, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(8, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(7, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(6, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(5, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(4, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(3, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(2, $iterableObject->getIterator()->current());

        $this->assertTrue($iterableObject->getIterator()->hasPrevious());

        $iterableObject->getIterator()->previous();
        $this->assertEquals(1, $iterableObject->getIterator()->current());

        $this->assertFalse($iterableObject->getIterator()->hasPrevious());

        return $iterableObject;
    }

    /**
     * @depends  testInit
     * @param    Iterable
     * @return   Iterable
     */
    public function testLast(Iterable $iterableObject)
    {
        $iterableObject->getIterator()->last();

        $this->assertEquals(10, $iterableObject->getIterator()->current());

        return $iterableObject;
    }

    /**
     * @depends  testLast
     * @param    Iterable
     * @return   Iterable
     */
    public function testFirst(Iterable $iterableObject)
    {
        $iterableObject->getIterator()->first();

        $this->assertEquals(1, $iterableObject->getIterator()->current());

        return $iterableObject;
    }

    /**
     * @depends  testInit
     * @param    Iterable
     * @return   Iterable
     */
    public function testIteration(Iterable $iterableObject)
    {
        $array = array();
        foreach ($iterableObject as $key => $value) {
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

        return $iterableObject;
    }

    /**
     * @depends  testFirst
     * @param    Iterable
     * @return   Iterable
     */
    public function testSetPosition(Iterable $iterableObject)
    {
        $iterableObject->getIterator()->setItemPosition(2);
        $this->assertEquals(2, $iterableObject->getIterator()->getItemPosition());
        $this->assertEquals(3, $iterableObject->getIterator()->current());

        $iterableObject->getIterator()->setItemPosition(9);
        $this->assertEquals(9, $iterableObject->getIterator()->getItemPosition());
        $this->assertEquals(10, $iterableObject->getIterator()->current());

        $iterableObject->getIterator()->setItemPosition(0);
        $this->assertEquals(0, $iterableObject->getIterator()->getItemPosition());
        $this->assertEquals(1, $iterableObject->getIterator()->current());

        $iterableObject->getIterator()->setItemPosition(6);
        $this->assertEquals(6, $iterableObject->getIterator()->getItemPosition());
        $this->assertEquals(7, $iterableObject->getIterator()->current());

        $iterableObject->getIterator()->setItemPosition(4);
        $this->assertEquals(4, $iterableObject->getIterator()->getItemPosition());
        $this->assertEquals(5, $iterableObject->getIterator()->current());

        return $iterableObject;
    }
}