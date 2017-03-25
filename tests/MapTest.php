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

use Naucon\Utility\Map;

class MapTest extends \PHPUnit_Framework_TestCase
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

        self::$mapKey[] = 'Key A';
        $obj = new \stdClass();
        $obj->value = 'Value A';
        self::$mapValue[] = $obj;

        self::$mapKey[] = 'Key B';
        $obj = new \stdClass();
        $obj->value = 'Value B';
        self::$mapValue[] = $obj;

        self::$mapKey[] = 'Key C';
        $obj = new \stdClass();
        $obj->value = 'Value C';
        self::$mapValue[] = $obj;

        self::$mapKey[] = 'Key D';
        $obj = new \stdClass();
        $obj->value = 'Value D';
        self::$mapValue[] = $obj;
    }


    /**
     * @return    Map
     */
    public function testInit()
    {
        $mapObject = new Map();
        return $mapObject;
    }

    /**
     * @depends   testInit
     * @return    Map
     */
    public function testSet(Map $mapObject)
    {
        $this->assertEquals($mapObject->set(self::$mapKey[0], self::$mapValue[0]), self::$mapValue[0]);
        $this->assertEquals($mapObject->set(self::$mapKey[1], self::$mapValue[1]), self::$mapValue[1]);
        $this->assertEquals($mapObject->set(self::$mapKey[2], self::$mapValue[2]), self::$mapValue[2]);

        return $mapObject;
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testHasKey(Map $mapObject)
    {
        $this->assertTrue($mapObject->hasKey(self::$mapKey[0]));
        $this->assertTrue($mapObject->hasKey(self::$mapKey[1]));
        $this->assertTrue($mapObject->hasKey(self::$mapKey[2]));
        $this->assertFalse($mapObject->hasKey(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testHasValue(Map $mapObject)
    {
        $this->assertTrue($mapObject->hasValue(self::$mapValue[0]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[1]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[2]));
        $this->assertFalse($mapObject->hasValue(self::$mapValue[3]));
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testGet(Map $mapObject)
    {
        $this->assertEquals($mapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertEquals($mapObject->get(self::$mapKey[1]), self::$mapValue[1]);
        $this->assertEquals($mapObject->get(self::$mapKey[2]), self::$mapValue[2]);
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testGetAll(Map $mapObject)
    {
        $map = $mapObject->getAll();

        $i = 0;
        foreach ($map as $key => $value) {
            $this->assertEquals($value, self::$mapValue[$i]);
            $i++;
        }
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testCount(Map $mapObject)
    {
        $this->assertEquals(count($mapObject), 3);
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testRemove(Map $mapObject)
    {
        $this->assertTrue($mapObject->remove(self::$mapKey[1]));
        $this->assertEquals(count($mapObject), 2);
        $this->assertEquals($mapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertNull($mapObject->get(self::$mapKey[1]));
        $this->assertEquals($mapObject->get(self::$mapKey[2]), self::$mapValue[2]);
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    Map
     * @return   void
     */
    public function testClear(Map $mapObject)
    {
        $mapObject->clear();
        $this->assertEquals(count($mapObject), 0);
        $this->assertNull($mapObject->get(self::$mapKey[0]));
        $this->assertNull($mapObject->get(self::$mapKey[1]));
        $this->assertNull($mapObject->get(self::$mapKey[2]));
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }
}