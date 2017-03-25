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

use Naucon\Utility\Iterator;
use Naucon\Utility\IteratorDecoratorAbstract;

class IteratorDecoratorAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    IteratorDecoratorAbstract
     */
    public function testInit()
    {
        $array = array();
        $array[] = 'item1';
        $array[] = 'item2';
        $array[] = 'item3';

        $iteratorObject = new TestIteratorDecorator(new Iterator($array));

        return $iteratorObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   void
     */
    public function testCount(IteratorDecoratorAbstract $iteratorObject)
    {
        $this->assertEquals(3, count($iteratorObject));
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   void
     */
    public function testCountItems(IteratorDecoratorAbstract $iteratorObject)
    {
        $this->assertEquals(3, $iteratorObject->countItems());
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testCurrent(IteratorDecoratorAbstract $iteratorObject)
    {
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());
        return $iteratorObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testNext(IteratorDecoratorAbstract $iteratorObject)
    {
        $this->assertTrue($iteratorObject->hasNext());

        $iteratorObject->next();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());

        $this->assertTrue($iteratorObject->hasNext());

        $iteratorObject->next();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        $this->assertFalse($iteratorObject->hasNext());

        return $iteratorObject;
    }

    /**
     * @depends  testNext
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testPrevious(IteratorDecoratorAbstract $iteratorObject)
    {
        $this->assertTrue($iteratorObject->hasPrevious());

        $iteratorObject->previous();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());

        $this->assertTrue($iteratorObject->hasPrevious());

        $iteratorObject->previous();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        $this->assertFalse($iteratorObject->hasPrevious());

        return $iteratorObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testLast(IteratorDecoratorAbstract $iteratorObject)
    {
        $iteratorObject->last();

        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        return $iteratorObject;
    }

    /**
     * @depends  testLast
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testFirst(IteratorDecoratorAbstract $iteratorObject)
    {
        $iteratorObject->first();

        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        return $iteratorObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testIteration(IteratorDecoratorAbstract $iteratorObject)
    {
        $array = array();
        foreach ($iteratorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(3, count($array));
        $this->assertEquals('item1', $array[0]);
        $this->assertEquals('item2', $array[1]);
        $this->assertEquals('item3', $array[2]);

        return $iteratorObject;
    }

    /**
     * @depends  testIteration
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testRewind(IteratorDecoratorAbstract $iteratorObject)
    {
        $iteratorObject->rewind();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());
        return $iteratorObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorAbstract
     * @return   IteratorDecoratorAbstract
     */
    public function testSetPosition(IteratorDecoratorAbstract $iteratorObject)
    {
        $iteratorObject->setItemPosition(2);
        $this->assertEquals(2, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        $iteratorObject->setItemPosition(1);
        $this->assertEquals(1, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());

        $iteratorObject->setItemPosition(0);
        $this->assertEquals(0, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        $iteratorObject->setItemPosition(2);
        $this->assertEquals(2, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        $iteratorObject->setItemPosition(0);
        $this->assertEquals(0, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        return $iteratorObject;
    }
}

class TestIteratorDecorator extends IteratorDecoratorAbstract
{

}