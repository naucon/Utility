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

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    Collection
     */
    public function testInit()
    {
        $collectionObject = new Collection(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        return $collectionObject;
    }

    /**
     * @depends  testInit
     * @param    Collection
     * @return   void
     */
    public function testCount(Collection $collectionObject)
    {
        $this->assertEquals(10, count($collectionObject));
    }

    /**
     * @depends  testInit
     * @param    Collection
     * @return   Collection
     */
    public function testIteration(Collection $collectionObject)
    {
        $array = array();
        foreach ($collectionObject as $key => $value) {
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

        return $collectionObject;
    }

    /**
     * @depends  testInit
     * @param    Collection
     * @return   void
     */
    public function testToArray(Collection $collectionObject)
    {
        $array = $collectionObject->toArray();

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
     * @param    Collection
     * @return   void
     */
    public function testContains(Collection $collectionObject)
    {
        $this->assertFalse($collectionObject->contains(40));
        $this->assertTrue($collectionObject->contains(9));
        $this->assertTrue($collectionObject->contains(10));
        $this->assertFalse($collectionObject->contains(20));
    }

    /**
     * @depends  testInit
     * @param    Collection
     * @return   Collection
     */
    public function testAdd(Collection $collectionObject)
    {
        $collectionObject->add(11);
        $collectionObject->add(12);

        $array = array();
        foreach ($collectionObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
        $this->assertEquals(11, $array[10]);
        $this->assertEquals(12, $array[11]);

        return $collectionObject;
    }

    /**
     * @depends  testAdd
     * @param    Collection
     * @return   void
     */
    public function testAddAll(Collection $collectionObject)
    {
        $collectionObject->addAll(array(13, 14, 15, 16));

        $array = array();
        foreach ($collectionObject as $key => $value) {
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

        $collectionObject->remove(4);
        $collectionObject->remove(10);

        $array = array();
        foreach ($collectionObject as $key => $value) {
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
     * @param    Collection
     * @return   void
     */
    public function testClear(Collection $collectionObject)
    {
        $this->assertFalse($collectionObject->isEmpty());
        $collectionObject->clear();
        $this->assertTrue($collectionObject->isEmpty());

    }
}
