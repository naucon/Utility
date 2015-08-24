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
use Naucon\Utility\IteratorDecoratorReverse;

class IteratorDecoratorReverseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return      IteratorDecoratorReverse
     */
    public function testInit()
    {
        $array = array();
        $array[] = 'item1';
        $array[] = 'item2';
        $array[] = 'item3';

        $iteratorObject = new IteratorDecoratorReverse(new Iterator($array));

        return $iteratorObject;
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      void
     */
    public function testCount(IteratorDecoratorReverse $iteratorObject)
    {
        $this->assertEquals(3, count($iteratorObject));
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      void
     */
    public function testCountItems(IteratorDecoratorReverse $iteratorObject)
    {
        $this->assertEquals(3, $iteratorObject->countItems());
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testCurrent(IteratorDecoratorReverse $iteratorObject)
    {
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());
        return $iteratorObject;
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testNext(IteratorDecoratorReverse $iteratorObject)
    {
        $this->assertTrue($iteratorObject->hasNext());

        $iteratorObject->next();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());

        $this->assertTrue($iteratorObject->hasNext());

        $iteratorObject->next();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        $this->assertFalse($iteratorObject->hasNext());

        return $iteratorObject;
    }

    /**
     * @depends     testNext
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testPrevious(IteratorDecoratorReverse $iteratorObject)
    {
        $this->assertTrue($iteratorObject->hasPrevious());

        $iteratorObject->previous();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());

        $this->assertTrue($iteratorObject->hasPrevious());

        $iteratorObject->previous();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        $this->assertFalse($iteratorObject->hasPrevious());

        return $iteratorObject;
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testLast(IteratorDecoratorReverse $iteratorObject)
    {
        $iteratorObject->last();

        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());

        return $iteratorObject;
    }

    /**
     * @depends     testLast
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testFirst(IteratorDecoratorReverse $iteratorObject)
    {
        $iteratorObject->first();

        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());

        return $iteratorObject;
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testIteration(IteratorDecoratorReverse $iteratorObject)
    {
        $array = array();
        foreach ($iteratorObject as $key => $value) {
            $array[] = $value;

            if ($key == 0) {
                $this->assertTrue($iteratorObject->isFirst());
                $this->assertFalse($iteratorObject->isLast());
            } elseif ($key == 2) {
                $this->assertFalse($iteratorObject->isFirst());
                $this->assertTrue($iteratorObject->isLast());
            } else {
                $this->assertFalse($iteratorObject->isFirst());
                $this->assertFalse($iteratorObject->isLast());
            }
        }
        $this->assertEquals(3, count($array));
        $this->assertEquals('item3', $array[0]);
        $this->assertEquals('item2', $array[1]);
        $this->assertEquals('item1', $array[2]);

        return $iteratorObject;
    }

    /**
     * @depends     testIteration
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testRewind(IteratorDecoratorReverse $iteratorObject)
    {
        $iteratorObject->rewind();
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());
        return $iteratorObject;
    }

    /**
     * @depends     testInit
     * @param       IteratorDecoratorReverse
     * @return      IteratorDecoratorReverse
     */
    public function testSetPosition(IteratorDecoratorReverse $iteratorObject)
    {
        $iteratorObject->setItemPosition(2);
        $this->assertEquals(2, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());
        $this->assertFalse($iteratorObject->isFirst());
        $this->assertTrue($iteratorObject->isLast());

        $iteratorObject->setItemPosition(1);
        $this->assertEquals(1, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(1, $iteratorObject->key());
        $this->assertEquals('item2', $iteratorObject->current());
        $this->assertFalse($iteratorObject->isFirst());
        $this->assertFalse($iteratorObject->isLast());

        $iteratorObject->setItemPosition(0);
        $this->assertEquals(0, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());
        $this->assertTrue($iteratorObject->isFirst());
        $this->assertFalse($iteratorObject->isLast());

        $iteratorObject->setItemPosition(2);
        $this->assertEquals(2, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(0, $iteratorObject->key());
        $this->assertEquals('item1', $iteratorObject->current());
        $this->assertFalse($iteratorObject->isFirst());
        $this->assertTrue($iteratorObject->isLast());

        $iteratorObject->setItemPosition(0);
        $this->assertEquals(0, $iteratorObject->getItemPosition());
        $this->assertTrue($iteratorObject->valid());
        $this->assertEquals(2, $iteratorObject->key());
        $this->assertEquals('item3', $iteratorObject->current());
        $this->assertTrue($iteratorObject->isFirst());
        $this->assertFalse($iteratorObject->isLast());

        return $iteratorObject;
    }
}