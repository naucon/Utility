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

use Naucon\Utility\HashMap;

class HashMapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    static protected $mapKey = array();

    /**
     * @var array
     */
    static protected $mapValue = array();


    /**
     * method is called before test class.
     */
    static public function setUpBeforeClass()
    {
        self::$mapKey = array();
        self::$mapValue = array();

        $obj = new \stdClass();
        $obj->value = 'Key A';
        self::$mapKey[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value A';
        self::$mapValue[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Key B';
        self::$mapKey[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value B';
        self::$mapValue[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Key C';
        self::$mapKey[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value C';
        self::$mapValue[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Key D';
        self::$mapKey[] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value D';
        self::$mapValue[] = $obj;
    }


    /**
     * @return    HashMap
     */
    public function testInit()
    {
        $hashMapObject = new HashMap();
        return $hashMapObject;
    }

    /**
     * @depends   testInit
     * @return    HashMap
     */
    public function testSet(HashMap $hashMapObject)
    {
        $this->assertEquals($hashMapObject->set(self::$mapKey[0], self::$mapValue[0]), self::$mapValue[0]);
        $this->assertEquals($hashMapObject->set(self::$mapKey[1], self::$mapValue[1]), self::$mapValue[1]);
        $this->assertEquals($hashMapObject->set(self::$mapKey[2], self::$mapValue[2]), self::$mapValue[2]);

        return $hashMapObject;
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testHasKey(HashMap $hashMapObject)
    {
        $this->assertTrue($hashMapObject->hasKey(self::$mapKey[0]));
        $this->assertTrue($hashMapObject->hasKey(self::$mapKey[1]));
        $this->assertTrue($hashMapObject->hasKey(self::$mapKey[2]));
        $this->assertFalse($hashMapObject->hasKey(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testHasValue(HashMap $hashMapObject)
    {
        $this->assertTrue($hashMapObject->hasValue(self::$mapValue[0]));
        $this->assertTrue($hashMapObject->hasValue(self::$mapValue[1]));
        $this->assertTrue($hashMapObject->hasValue(self::$mapValue[2]));
        $this->assertFalse($hashMapObject->hasValue(self::$mapValue[3]));
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testGet(HashMap $hashMapObject)
    {
        $this->assertEquals($hashMapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertEquals($hashMapObject->get(self::$mapKey[1]), self::$mapValue[1]);
        $this->assertEquals($hashMapObject->get(self::$mapKey[2]), self::$mapValue[2]);
        $this->assertNull($hashMapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testGetAll(HashMap $hashMapObject)
    {
        $map = $hashMapObject->getAll();

        $i = 0;
        foreach ($map as $key => $value) {
            $this->assertEquals($value, self::$mapValue[$i]);
            $i++;
        }
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testCount(HashMap $hashMapObject)
    {
        $this->assertEquals(count($hashMapObject), 3);
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testRemove(HashMap $hashMapObject)
    {
        $this->assertTrue($hashMapObject->remove(self::$mapKey[1]));
        $this->assertEquals(count($hashMapObject), 2);
        $this->assertEquals($hashMapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertNull($hashMapObject->get(self::$mapKey[1]));
        $this->assertEquals($hashMapObject->get(self::$mapKey[2]), self::$mapValue[2]);
        $this->assertNull($hashMapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    HashMap
     * @return   void
     */
    public function testClear(HashMap $hashMapObject)
    {
        $hashMapObject->clear();
        $this->assertEquals(count($hashMapObject), 0);
        $this->assertNull($hashMapObject->get(self::$mapKey[0]));
        $this->assertNull($hashMapObject->get(self::$mapKey[1]));
        $this->assertNull($hashMapObject->get(self::$mapKey[2]));
        $this->assertNull($hashMapObject->get(self::$mapKey[3]));
    }
}