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

use Naucon\Utility\Set;

class SetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    Set
     */
    public function testInit()
    {
        $setObject = new Set();
        $setObject->addAll(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        return $setObject;
    }

    /**
     * @depends  testInit
     * @param    Set
     * @return   void
     */
    public function testCount(Set $setObject)
    {
        $this->assertEquals(10, count($setObject));
    }

    /**
     * @depends  testInit
     * @param    Set
     * @return   Set
     */
    public function testIteration(Set $setObject)
    {
        $array = array();
        foreach ($setObject as $key => $value) {
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

        return $setObject;
    }

    /**
     * @depends  testInit
     * @param    Set
     * @return   void
     */
    public function testToArray(Set $setObject)
    {
        $array = $setObject->toArray();

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
     * @param    Set
     * @return   void
     */
    public function testContains(Set $setObject)
    {
        $this->assertFalse($setObject->contains(40));
        $this->assertTrue($setObject->contains(9));
        $this->assertTrue($setObject->contains(10));
        $this->assertFalse($setObject->contains(20));
    }

    /**
     * @depends  testInit
     * @param    Set
     * @return   Set
     */
    public function testAdd(Set $setObject)
    {
        $setObject->add(11);
        $setObject->add(12);

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
        $this->assertEquals(11, $array[10]);
        $this->assertEquals(12, $array[11]);

        return $setObject;
    }

    /**
     * @depends  testAdd
     * @param    Set
     * @return   Set
     */
    public function testAddDuplicate(Set $setObject)
    {
        $this->assertFalse($setObject->add(11)); // duplicate element

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
    }

    /**
     * @depends  testAdd
     * @param    Set
     * @return   Set
     */
    public function testAddAll(Set $setObject)
    {
        $setObject->addAll(array(13, 14, 15, 16));

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(16, count($array));
        $this->assertEquals(13, $array[12]);
        $this->assertEquals(14, $array[13]);
        $this->assertEquals(15, $array[14]);
        $this->assertEquals(16, $array[15]);

        return $setObject;
    }

    /**
     * @depends  testAddAll
     * @param    Set
     * @return   Set
     */
    public function testAddAllDuplicate(Set $setObject)
    {
        $setObject->addAll(array(17, 11, 12, 18)); // 11 and 12 are duplicate elements

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }

        $this->assertEquals(18, count($array));
        $this->assertEquals(13, $array[12]);
        $this->assertEquals(14, $array[13]);
        $this->assertEquals(15, $array[14]);
        $this->assertEquals(16, $array[15]);
        $this->assertEquals(17, $array[16]);
        $this->assertEquals(18, $array[17]);
    }

    /**
     * @return    void
     */
    public function testRemove()
    {
        $setObject = new Set();
        $setObject->addAll(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));

        $setObject->remove(4);
        $setObject->remove(10);

        $array = array();
        foreach ($setObject as $key => $value) {
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
     * @param    Set
     * @return   void
     */
    public function testClear(Set $setObject)
    {
        $this->assertFalse($setObject->isEmpty());
        $setObject->clear();
        $this->assertTrue($setObject->isEmpty());

    }
}