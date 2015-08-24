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

use Naucon\Utility\TreeMap;

class TreeMapTest extends \PHPUnit_Framework_TestCase
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
        self::$mapKey[0] = 'Key A';
        $obj = new \stdClass();
        $obj->value = 'Value A';
        self::$mapValue[0] = $obj;

        self::$mapKey[1] = 'Key B';
        $obj = new \stdClass();
        $obj->value = 'Value B';
        self::$mapValue[1] = $obj;

        self::$mapKey[2] = 'Key C';
        $obj = new \stdClass();
        $obj->value = 'Value C1';
        self::$mapValue[2][0] = $obj;
        $obj = new \stdClass();
        $obj->value = 'Value C2';
        self::$mapValue[2][1] = $obj;
        $obj = new \stdClass();
        $obj->value = 'Value C3';
        self::$mapValue[2][2] = $obj;

        self::$mapKey[3] = 'Key D';
        $obj = new \stdClass();
        $obj->value = 'Value D';
        self::$mapValue[3] = $obj;
    }


    /**
     * @return    TreeMap
     */
    public function testInit()
    {
        $mapObject = new TreeMap();
        return $mapObject;
    }

    /**
     * @depends   testInit
     * @return    TreeMap
     */
    public function testSet(TreeMap $mapObject)
    {
        $this->assertEquals($mapObject->set(self::$mapKey[0], self::$mapValue[0]), self::$mapValue[0]);
        $this->assertEquals($mapObject->set(self::$mapKey[1], self::$mapValue[1]), self::$mapValue[1]);
        $this->assertEquals($mapObject->set(self::$mapKey[2], self::$mapValue[2][0]), self::$mapValue[2][0]);
        //$this->assertEquals( $mapObject->set(self::$mapKey[3], self::$mapValue[3]), self::$mapValue[3] );
        $this->assertEquals($mapObject->set(self::$mapKey[2], self::$mapValue[2][1]), self::$mapValue[2][1]);
        $this->assertEquals($mapObject->set(self::$mapKey[2], self::$mapValue[2][2]), self::$mapValue[2][2]);

        return $mapObject;
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testHasKey(TreeMap $mapObject)
    {
        $this->assertTrue($mapObject->hasKey(self::$mapKey[0]));
        $this->assertTrue($mapObject->hasKey(self::$mapKey[1]));
        $this->assertTrue($mapObject->hasKey(self::$mapKey[2]));
        $this->assertFalse($mapObject->hasKey(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testHasValue(TreeMap $mapObject)
    {
        $this->assertTrue($mapObject->hasValue(self::$mapValue[0]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[1]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[2][0]));
        $this->assertFalse($mapObject->hasValue(self::$mapValue[3]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[2][1]));
        $this->assertTrue($mapObject->hasValue(self::$mapValue[2][2]));
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testGet(TreeMap $mapObject)
    {
        $this->assertEquals($mapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertEquals($mapObject->get(self::$mapKey[1]), self::$mapValue[1]);
        $value = $mapObject->get(self::$mapKey[2]);
        $this->assertInternalType('array', $value);
        $this->assertEquals(count($value), 3);
        $this->assertEquals($value[0], self::$mapValue[2][0]);
        $this->assertEquals($value[1], self::$mapValue[2][1]);
        $this->assertEquals($value[2], self::$mapValue[2][2]);
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testGetAll(TreeMap $mapObject)
    {
        $map = $mapObject->getAll();

        $i = 0;
        foreach ($map as $key => $value) {
            $this->assertEquals($key, self::$mapKey[$i]);

            $expectedValue = self::$mapValue[$i];
            if (is_array($expectedValue)) {
                $this->assertEquals($value, $expectedValue);
            } else {
                $this->assertEquals($value, array($expectedValue));
            }
            $i++;
        }
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testCount(TreeMap $mapObject)
    {
        $this->assertEquals(count($mapObject), 3);
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testRemove(TreeMap $mapObject)
    {
        $this->assertTrue($mapObject->remove(self::$mapKey[1]));
        $this->assertEquals(count($mapObject), 2);
        $this->assertEquals($mapObject->get(self::$mapKey[0]), self::$mapValue[0]);
        $this->assertNull($mapObject->get(self::$mapKey[1]));
        $this->assertInternalType('array', $mapObject->get(self::$mapKey[2]));
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }

    /**
     * @depends  testSet
     * @param    TreeMap
     * @return   void
     */
    public function testClear(TreeMap $mapObject)
    {
        $mapObject->clear();
        $this->assertEquals(count($mapObject), 0);
        $this->assertNull($mapObject->get(self::$mapKey[0]));
        $this->assertNull($mapObject->get(self::$mapKey[1]));
        $this->assertNull($mapObject->get(self::$mapKey[2]));
        $this->assertNull($mapObject->get(self::$mapKey[3]));
    }
}