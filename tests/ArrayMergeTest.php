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

use Naucon\Utility\ArrayMerge;

class ArrayMergeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @static
     * @var         array
     */
    protected static $defaultArray = array();

    /**
     * @static
     * @var         array
     */
    protected static $deviationArray1 = array();

    /**
     * @static
     * @var         array
     */
    protected static $deviationArray2 = array();


    /**
     * setup class
     */
    public static function setUpBeforeClass()
    {
        self::$defaultArray['key1'] = false;
        self::$defaultArray['key2'] = false;
        self::$defaultArray['keyset3']['key31'] = false;
        self::$defaultArray['keyset3']['key32'] = false;
        self::$defaultArray['keyset3']['keyset33']['key331'] = false;
        self::$defaultArray['keyset3']['keyset33']['key332'] = false;
        self::$defaultArray['key4'] = false;
        self::$defaultArray['key5'] = false;

        self::$deviationArray1['key1'] = true;
        self::$deviationArray1['keyset3']['key31'] = true;
        self::$deviationArray1['keyset3']['keyset33']['key332'] = true;
        self::$deviationArray1['key4'] = true;

        self::$deviationArray2['key2'] = true;
        self::$deviationArray2['keyset3']['key31'] = false;
        self::$deviationArray2['key4'] = false;
        self::$deviationArray2['key5'] = true;
    }

    /**
     * tear down class
     */
    public static function tearDownAfterClass()
    {
        self::$defaultArray = null;
        self::$deviationArray1 = null;
        self::$deviationArray2 = null;
    }

    /**
     * @return      ArrayMerge
     */
    public function testInit()
    {
        $arrayMergeObject = new ArrayMerge(self::$defaultArray, self::$deviationArray1);

        $this->assertEquals(self::$defaultArray, $arrayMergeObject->getDefaultArray());
        $this->assertEquals(self::$deviationArray1, $arrayMergeObject->getDeviationArray1());
        $this->assertEquals(array(), $arrayMergeObject->getDeviationArray2());

        return $arrayMergeObject;
    }

    /**
     * @depends     testInit
     * @param       ArrayMerge
     * @return      void
     */
    public function testMerge(ArrayMerge $arrayMergeObject)
    {
        $mergedArray1['key1'] = true;
        $mergedArray1['key2'] = false;
        $mergedArray1['keyset3']['key31'] = true;
        $mergedArray1['keyset3']['key32'] = false;
        $mergedArray1['keyset3']['keyset33']['key331'] = false;
        $mergedArray1['keyset3']['keyset33']['key332'] = true;
        $mergedArray1['key4'] = true;
        $mergedArray1['key5'] = false;

        $this->assertEquals($mergedArray1, $arrayMergeObject->getMergedArray1());
        $this->assertEquals($mergedArray1, $arrayMergeObject->getMergedArray2());
        $this->assertEquals($mergedArray1, $arrayMergeObject->getMergedArray()); // alias of getMergedArray2()
    }

    /**
     * @depends     testInit
     * @param       ArrayMerge
     * @return      void
     */
    public function testGet(ArrayMerge $arrayMergeObject)
    {
        $this->assertTrue($arrayMergeObject->get('key1'));
        $this->assertFalse($arrayMergeObject->get('key2'));
        $this->assertTrue($arrayMergeObject->get('keyset3.key31'));
        $this->assertFalse($arrayMergeObject->get('keyset3.key32'));
        $this->assertFalse($arrayMergeObject->get('keyset3.keyset33.key331'));
        $this->assertTrue($arrayMergeObject->get('keyset3.keyset33.key332'));
        $this->assertTrue($arrayMergeObject->get('key4'));
        $this->assertFalse($arrayMergeObject->get('key5'));
    }

    /**
     * @depends     testInit
     * @param       ArrayMerge
     * @return      void
     */
    public function testSet(ArrayMerge $arrayMergeObject)
    {
        $arrayMergeObject->set('key2', true);
        $arrayMergeObject->set('keyset3.key32', true);
        $arrayMergeObject->set('keyset3.keyset33.key331', true);
        $arrayMergeObject->set('key5', true);

        $this->assertTrue($arrayMergeObject->get('key2'));
        $this->assertTrue($arrayMergeObject->get('keyset3.key32'));
        $this->assertTrue($arrayMergeObject->get('keyset3.keyset33.key331'));
        $this->assertTrue($arrayMergeObject->get('key5'));
    }

    /**
     * @depends     testInit
     * @param       ArrayMerge
     * @return      void
     */
    public function testDel(ArrayMerge $arrayMergeObject)
    {
        $arrayMergeObject->del('key2');
        $this->assertNull($arrayMergeObject->get('key2'));
        $this->assertTrue($arrayMergeObject->get('key1'));

        $arrayMergeObject->del('keyset3.key32');
        $this->assertNull($arrayMergeObject->get('keyset3.key32'));
        $this->assertTrue($arrayMergeObject->get('keyset3.key31'));

        $arrayMergeObject->del('keyset3.keyset33.key331');
        $this->assertNull($arrayMergeObject->get('keyset3.keyset33.key331'));
        $this->assertTrue($arrayMergeObject->get('keyset3.keyset33.key332'));

        $arrayMergeObject->del('keyset3.keyset33');
        $this->assertNull($arrayMergeObject->get('keyset3.keyset33'));
        $this->assertNull($arrayMergeObject->get('keyset3.keyset33.key332'));
        $this->assertTrue($arrayMergeObject->get('keyset3.key31'));

        $arrayMergeObject->del('key5');
        $this->assertNull($arrayMergeObject->get('key5'));
        $this->assertTrue($arrayMergeObject->get('key4'));
    }

    /**
     * @depends     testInit
     * @param       ArrayMerge
     * @return      void
     */
    public function testShowPath(ArrayMerge $arrayMergeObject)
    {
        $this->assertFalse($arrayMergeObject->getShowPath()); // default value

        $arrayMergeObject->setShowPath(true);

        $this->assertTrue($arrayMergeObject->getShowPath());

        $this->assertEquals('key1', $arrayMergeObject->get('key1'));
        $this->assertEquals('keyset3.key31', $arrayMergeObject->get('keyset3.key31'));
        $this->assertEquals('keyset3.keyset33.key331', $arrayMergeObject->get('keyset3.keyset33.key331'));
        $this->assertEquals('key4', $arrayMergeObject->get('key4'));
    }

    /**
     * @return      ArrayMerge
     */
    public function testInit2()
    {
        $arrayMergeObject = new ArrayMerge(self::$defaultArray, self::$deviationArray1, self::$deviationArray2);

        $this->assertEquals(self::$defaultArray, $arrayMergeObject->getDefaultArray());
        $this->assertEquals(self::$deviationArray1, $arrayMergeObject->getDeviationArray1());
        $this->assertEquals(self::$deviationArray2, $arrayMergeObject->getDeviationArray2());

        return $arrayMergeObject;
    }

    /**
     * @depends     testInit2
     * @param       ArrayMerge
     * @return      void
     */
    public function testMerge2(ArrayMerge $arrayMergeObject)
    {
        $mergedArray1['key1'] = true;
        $mergedArray1['key2'] = false;
        $mergedArray1['keyset3']['key31'] = true;
        $mergedArray1['keyset3']['key32'] = false;
        $mergedArray1['keyset3']['keyset33']['key331'] = false;
        $mergedArray1['keyset3']['keyset33']['key332'] = true;
        $mergedArray1['key4'] = true;
        $mergedArray1['key5'] = false;

        $mergedArray2['key1'] = true;
        $mergedArray2['key2'] = true;
        $mergedArray2['keyset3']['key31'] = false;
        $mergedArray2['keyset3']['key32'] = false;
        $mergedArray2['keyset3']['keyset33']['key331'] = false;
        $mergedArray2['keyset3']['keyset33']['key332'] = true;
        $mergedArray2['key4'] = false;
        $mergedArray2['key5'] = true;

        $this->assertEquals($mergedArray1, $arrayMergeObject->getMergedArray1());
        $this->assertEquals($mergedArray2, $arrayMergeObject->getMergedArray2());
        $this->assertEquals($mergedArray2, $arrayMergeObject->getMergedArray()); // alias of getMergedArray2()
    }

    /**
     * @depends     testInit2
     * @param       ArrayMerge
     * @return      void
     */
    public function testGet2(ArrayMerge $arrayMergeObject)
    {
        $this->assertTrue($arrayMergeObject->get('key1'));
        $this->assertTrue($arrayMergeObject->get('key2'));
        $this->assertFalse($arrayMergeObject->get('keyset3.key31'));
        $this->assertFalse($arrayMergeObject->get('keyset3.key32'));
        $this->assertFalse($arrayMergeObject->get('keyset3.keyset33.key331'));
        $this->assertTrue($arrayMergeObject->get('keyset3.keyset33.key332'));
        $this->assertFalse($arrayMergeObject->get('key4'));
        $this->assertTrue($arrayMergeObject->get('key5'));
    }
}