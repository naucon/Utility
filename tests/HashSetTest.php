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

use Naucon\Utility\HashSet;

class HashSetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    static protected $setValues = null;

    /**
     * @var array
     */
    static protected $workingValues = null;


    /**
     * method is called before test class.
     */
    static public function setUpBeforeClass()
    {
        self::$setValues = array();
        $obj = new \stdClass();
        $obj->value = 'Value 1';
        self::$setValues[1] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 2';
        self::$setValues[2] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 3';
        self::$setValues[3] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 4';
        self::$setValues[4] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 5';
        self::$setValues[5] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 6';
        self::$setValues[6] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 7';
        self::$setValues[7] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 8';
        self::$setValues[8] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 9';
        self::$setValues[9] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 10';
        self::$setValues[10] = $obj;

        self::$workingValues = self::$setValues;
    }

    /**
     * method is called after test class.
     */
    public static function tearDownAfterClass()
    {
        self::$setValues = null;
        self::$workingValues = null;
    }


    /**
     * @return    HashSet
     */
    public function testInit()
    {
        $setObject = new HashSet();
        $setObject->addAll(self::$setValues);
        return $setObject;
    }

    /**
     * @depends  testInit
     * @param    HashSet
     * @return   void
     */
    public function testCount(HashSet $setObject)
    {
        $this->assertEquals(10, count($setObject));
    }

    /**
     * @depends  testInit
     * @param    HashSet
     * @return   HashSet
     */
    public function testIteration(HashSet $setObject)
    {
        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));
        $this->assertEquals(self::$setValues[1], $array[0]);
        $this->assertEquals(self::$setValues[2], $array[1]);
        $this->assertEquals(self::$setValues[3], $array[2]);
        $this->assertEquals(self::$setValues[4], $array[3]);
        $this->assertEquals(self::$setValues[5], $array[4]);
        $this->assertEquals(self::$setValues[6], $array[5]);
        $this->assertEquals(self::$setValues[7], $array[6]);
        $this->assertEquals(self::$setValues[8], $array[7]);
        $this->assertEquals(self::$setValues[9], $array[8]);
        $this->assertEquals(self::$setValues[10], $array[9]);

        return $setObject;
    }

    /**
     * @depends  testInit
     * @param    HashSet
     * @return   void
     */
    public function testToArray(HashSet $setObject)
    {
        $array = $setObject->toArray();

        $this->assertEquals(10, count($array));
        $this->assertEquals(self::$setValues[1], $array[0]);
        $this->assertEquals(self::$setValues[2], $array[1]);
        $this->assertEquals(self::$setValues[3], $array[2]);
        $this->assertEquals(self::$setValues[4], $array[3]);
        $this->assertEquals(self::$setValues[5], $array[4]);
        $this->assertEquals(self::$setValues[6], $array[5]);
        $this->assertEquals(self::$setValues[7], $array[6]);
        $this->assertEquals(self::$setValues[8], $array[7]);
        $this->assertEquals(self::$setValues[9], $array[8]);
        $this->assertEquals(self::$setValues[10], $array[9]);
    }

    /**
     * @depends  testInit
     * @param    HashSet
     * @return   void
     */
    public function testContains(HashSet $setObject)
    {
        $obj = new \stdClass();
        $obj->value = 'Value 40';
        $this->assertFalse($setObject->contains($obj));

        $this->assertTrue($setObject->contains(self::$setValues[9]));
        $this->assertTrue($setObject->contains(self::$setValues[10]));

        $obj = new \stdClass();
        $obj->value = 'Value 20';
        $this->assertFalse($setObject->contains($obj));
    }

    /**
     * @depends  testInit
     * @param    HashSet
     * @return   HashSet
     */
    public function testAdd(HashSet $setObject)
    {
        $obj = new \stdClass();
        $obj->value = 'Value 11';
        self::$workingValues[11] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 12';
        self::$workingValues[12] = $obj;

        $setObject->add(self::$workingValues[11]);
        $setObject->add(self::$workingValues[12]);

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
        $this->assertEquals(self::$workingValues[11], $array[10]);
        $this->assertEquals(self::$workingValues[12], $array[11]);

        return $setObject;
    }

    /**
     * @depends   testAdd
     * @param     HashSet
     * @return    HashSet
     */
    public function testAddDuplicate(HashSet $setObject)
    {
        $this->assertFalse($setObject->add(self::$workingValues[11])); // duplicate element

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(12, count($array));
    }

    /**
     * @depends  testAdd
     * @param    HashSet
     * @return   HashSet
     */
    public function testAddAll(HashSet $setObject)
    {
        $obj = new \stdClass();
        $obj->value = 'Value 13';
        self::$workingValues[13] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 14';
        self::$workingValues[14] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 15';
        self::$workingValues[15] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 16';
        self::$workingValues[16] = $obj;

        $addArray = array();
        $addArray[] = self::$workingValues[13];
        $addArray[] = self::$workingValues[14];
        $addArray[] = self::$workingValues[15];
        $addArray[] = self::$workingValues[16];

        $setObject->addAll($addArray);

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(16, count($array));
        $this->assertEquals(self::$workingValues[13], $array[12]);
        $this->assertEquals(self::$workingValues[14], $array[13]);
        $this->assertEquals(self::$workingValues[15], $array[14]);
        $this->assertEquals(self::$workingValues[16], $array[15]);

        return $setObject;
    }

    /**
     * @depends  testAddAll
     * @param    HashSet
     * @return   HashSet
     */
    public function testAddAllDuplicate(HashSet $setObject)
    {
        $obj = new \stdClass();
        $obj->value = 'Value 17';
        self::$workingValues[17] = $obj;

        $obj = new \stdClass();
        $obj->value = 'Value 18';
        self::$workingValues[18] = $obj;

        $addArray = array();
        $addArray[] = self::$workingValues[17];
        $addArray[] = self::$workingValues[11];
        $addArray[] = self::$workingValues[12];
        $addArray[] = self::$workingValues[18];

        $setObject->addAll($addArray); // 11 and 12 are duplicate elements

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }

        $this->assertEquals(18, count($array));
        $this->assertEquals(self::$workingValues[17], $array[16]);
        $this->assertEquals(self::$workingValues[18], $array[17]);
    }

    /**
     * @return    void
     */
    public function testRemove()
    {
        $setObject = new HashSet();
        $setObject->addAll(self::$setValues);

        $setObject->remove(self::$setValues[4]);
        $setObject->remove(self::$setValues[10]);

        $array = array();
        foreach ($setObject as $key => $value) {
            $array[] = $value;
        }

        $this->assertEquals(8, count($array));

        $this->assertEquals(self::$setValues[1], $array[0]);
        $this->assertEquals(self::$setValues[2], $array[1]);
        $this->assertEquals(self::$setValues[3], $array[2]);
        $this->assertEquals(self::$setValues[5], $array[3]);
        $this->assertEquals(self::$setValues[6], $array[4]);
        $this->assertEquals(self::$setValues[7], $array[5]);
        $this->assertEquals(self::$setValues[8], $array[6]);
        $this->assertEquals(self::$setValues[9], $array[7]);
    }

    /**
     * @depends testInit
     * @param    HashSet
     * @return    void
     */
    public function testClear(HashSet $setObject)
    {
        $this->assertFalse($setObject->isEmpty());
        $setObject->clear();
        $this->assertTrue($setObject->isEmpty());

    }
}