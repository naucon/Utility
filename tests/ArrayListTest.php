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

use Naucon\Utility\ArrayList;

class ArrayListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    ArrayList
     */
    public function testInit()
    {
        $listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        return $listObject;
    }

    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   void
     */
    public function testCount(ArrayList $listObject)
    {
        $this->assertEquals(10, count($listObject));
    }


    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   ArrayList
     */
    public function testIteration(ArrayList $listObject)
    {
        $array = array();
        foreach ($listObject as $key => $value) {
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

        return $listObject;
    }

    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   void
     */
    public function testToArray(ArrayList $listObject)
    {
        $array = $listObject->toArray();

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
     * @param    ArrayList
     * @return   void
     */
    public function testContains(ArrayList $listObject)
    {
        $this->assertFalse($listObject->contains(40));
        $this->assertTrue($listObject->contains(9));
        $this->assertTrue($listObject->contains(10));
        $this->assertFalse($listObject->contains(20));
    }

    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   void
     */
    public function testGet(ArrayList $listObject)
    {
        $this->assertEquals(1, $listObject->get(0));
        $this->assertEquals(2, $listObject->get(1));
        $this->assertEquals(3, $listObject->get(2));
        $this->assertEquals(4, $listObject->get(3));
        $this->assertEquals(5, $listObject->get(4));
        $this->assertEquals(6, $listObject->get(5));
        $this->assertEquals(7, $listObject->get(6));
        $this->assertEquals(8, $listObject->get(7));
        $this->assertEquals(9, $listObject->get(8));
        $this->assertEquals(10, $listObject->get(9));
    }

    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   ArrayList
     */
    public function testAdd(ArrayList $listObject)
    {
        $listObject->add(11);
        $listObject->add(12);

        $array = array();
        foreach ($listObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
        $this->assertEquals(11, $array[10]);
        $this->assertEquals(12, $array[11]);

        return $listObject;
    }

    /**
     * @depends  testAdd
     * @param    ArrayList
     * @return   ArrayList
     */
    public function testAddAll(ArrayList $listObject)
    {
        $listObject->addAll(array(13, 14, 15, 16));

        $array = array();
        foreach ($listObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(16, count($array));
        $this->assertEquals(13, $array[12]);
        $this->assertEquals(14, $array[13]);
        $this->assertEquals(15, $array[14]);
        $this->assertEquals(16, $array[15]);

        return $listObject;
    }

    /**
     * @depends  testAddAll
     * @param    ArrayList
     * @return   ArrayList
     */
    public function testAddWithIndex(ArrayList $listObject)
    {
        $listObject->addWithIndex(16, 17);
        $listObject->addWithIndex(17, 18);

        $array = array();
        foreach ($listObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(18, count($array));
        $this->assertEquals(17, $array[16]);
        $this->assertEquals(18, $array[17]);

        return $listObject;
    }

    /**
     * @depends  testAddWithIndex
     * @param    ArrayList
     * @return   ArrayList
     */
    public function testSet(ArrayList $listObject)
    {
        $listObject->set(18, 19);
        $listObject->set(10, 99);

        $array = array();
        foreach ($listObject as $key => $value) {
            $array[] = $value;
        }

        $this->assertEquals(19, count($array));
        $this->assertEquals(19, $array[18]);
        $this->assertEquals(99, $array[10]);

        return $listObject;
    }

    /**
     * @return    void
     */
    public function testRemove()
    {
        $listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));

        $listObject->remove(4);
        $listObject->remove(10);
        $listObject->remove(15);

        $array = array();
        foreach ($listObject as $key => $value) {
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
     * @return    void
     */
    public function testRemoveIndex()
    {
        $listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12));

        $listObject->removeIndex(4);
        $listObject->removeIndex(10);
        $listObject->removeIndex(15);

        $array = array();
        foreach ($listObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));
        $this->assertEquals(1, $array[0]);
        $this->assertEquals(2, $array[1]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(4, $array[3]);
        $this->assertEquals(6, $array[4]);
        $this->assertEquals(7, $array[5]);
        $this->assertEquals(8, $array[6]);
        $this->assertEquals(9, $array[7]);
        $this->assertEquals(10, $array[8]);
        $this->assertEquals(12, $array[9]);
    }

    /**
     * @depends  testInit
     * @param    ArrayList
     * @return   void
     */
    public function testClear(ArrayList $listObject)
    {
        $this->assertFalse($listObject->isEmpty());
        $listObject->clear();
        $this->assertTrue($listObject->isEmpty());

    }
}