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

use Naucon\Utility\Collection;
use Naucon\Utility\CollectionDecorator;
use Naucon\Utility\CollectionDecoratorAbstract;

class CollectionDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    CollectionDecoratorAbstract
     */
    public function testInit()
    {
        $collectionObject = new Collection(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        $collectionDecoratorObject = new CollectionDecorator($collectionObject);
        return $collectionDecoratorObject;
    }

    /**
     * @depends  testInit
     * @param    CollectionDecoratorAbstract
     * @return   void
     */
    public function testCount(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $this->assertEquals(10, count($collectionDecoratorObject));
    }

    /**
     * @depends  testInit
     * @param    CollectionDecoratorAbstract
     * @return   CollectionDecoratorAbstract
     */
    public function testIteration(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $array = array();
        foreach ($collectionDecoratorObject as $key => $value) {
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

        return $collectionDecoratorObject;
    }

    /**
     * @depends  testInit
     * @param    CollectionDecoratorAbstract
     * @return   void
     */
    public function testToArray(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $array = $collectionDecoratorObject->toArray();

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
    }

    /**
     * @depends  testInit
     * @param    CollectionDecoratorAbstract
     * @return   void
     */
    public function testContains(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $this->assertFalse($collectionDecoratorObject->contains(40));
        $this->assertTrue($collectionDecoratorObject->contains(9));
        $this->assertTrue($collectionDecoratorObject->contains(10));
        $this->assertFalse($collectionDecoratorObject->contains(20));
    }

    /**
     * @depends  testInit
     * @param    CollectionDecoratorAbstract
     * @return   CollectionDecoratorAbstract
     */
    public function testAdd(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $collectionDecoratorObject->add(11);
        $collectionDecoratorObject->add(12);

        $array = array();
        foreach ($collectionDecoratorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
        $this->assertEquals(11, $array[10]);
        $this->assertEquals(12, $array[11]);

        return $collectionDecoratorObject;
    }

    /**
     * @depends  testAdd
     * @param    CollectionDecoratorAbstract
     * @return   void
     */
    public function testAddAll(CollectionDecoratorAbstract $collectionDecoratorObject)
    {
        $collectionDecoratorObject->addAll(array(13, 14, 15, 16));

        $array = array();
        foreach ($collectionDecoratorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(16, count($array));
        $this->assertEquals(13, $array[12]);
        $this->assertEquals(14, $array[13]);
        $this->assertEquals(15, $array[14]);
        $this->assertEquals(16, $array[15]);
    }

    /**
     * @return    void
     */
    public function testRemove()
    {
        $collectionObject = new Collection(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        $collectionDecoratorObject = new CollectionDecorator($collectionObject);

        $collectionDecoratorObject->remove(4);
        $collectionDecoratorObject->remove(10);

        $array = array();
        foreach ($collectionDecoratorObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(8, count($array));
        $this->assertEquals(1, $array[0]);
        $this->assertEquals(2, $array[1]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(5, $array[3]);
        $this->assertEquals(6, $array[4]);
        $this->assertEquals(7, $array[5]);
        $this->assertEquals(8, $array[6]);
        $this->assertEquals(9, $array[7]);
    }

    /**
     * @depends  testInit
     * @param    CollectionDecorator
     * @return   void
     */
    public function testClear(CollectionDecorator $collectionDecoratorObject)
    {
        $this->assertFalse($collectionDecoratorObject->isEmpty());
        $collectionDecoratorObject->clear();
        $this->assertTrue($collectionDecoratorObject->isEmpty());

    }
}
