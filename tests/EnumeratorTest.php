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

use Naucon\Utility\Enumerator;
use Naucon\Utility\EnumeratorAbstract;

class EnumeratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    EnumeratorAbstract
     */
    public function testSimpleInit()
    {
        $enumeratorObject = new Enumerator('RED', 'BLUE', 'GREEN', 'YELLOW', 'BLACK');
        return $enumeratorObject;
    }

    /**
     * @depends  testSimpleInit
     * @param    EnumeratorAbstract
     * @return   void
     */
    public function testSimpleGet(EnumeratorAbstract $enumeratorObject)
    {
        $this->assertEquals('RED', $enumeratorObject->RED);
        $this->assertEquals('BLUE', $enumeratorObject->BLUE);
        $this->assertEquals('GREEN', $enumeratorObject->GREEN);
        $this->assertEquals('YELLOW', $enumeratorObject->YELLOW);
        $this->assertEquals('BLACK', $enumeratorObject->BLACK);
    }

    /**
     * @depends  testSimpleInit
     * @param    EnumeratorAbstract
     * @return   void
     */
    public function testSimpleIteration(EnumeratorAbstract $enumeratorObject)
    {
        $result = array();
        foreach ($enumeratorObject as $key => $value) {
            $result[] = $value;
        }

        $this->assertEquals(5, count($result));
        $this->assertEquals('RED', $result[0]);
        $this->assertEquals('BLUE', $result[1]);
        $this->assertEquals('GREEN', $result[2]);
        $this->assertEquals('YELLOW', $result[3]);
        $this->assertEquals('BLACK', $result[4]);
    }

    /**
     * @return    EnumeratorAbstract
     */
    public function testEntryInit()
    {
        $enumeratorObject = new Enumerator();
        $enumeratorObject->RED = 'FF0000';
        $enumeratorObject->BLUE = '0000FF';
        return $enumeratorObject;
    }

    /**
     * @depends  testEntryInit
     * @param    EnumeratorAbstract
     * @return   EnumeratorAbstract
     */
    public function testEntrySet(EnumeratorAbstract $enumeratorObject)
    {
        $this->assertEquals('00FF00', $enumeratorObject->set('GREEN', '00FF00'));
        $this->assertEquals('FFFF00', $enumeratorObject->set('YELLOW', 'FFFF00'));
        $this->assertEquals('000000', $enumeratorObject->set('BLACK', '000000'));

        return $enumeratorObject;
    }

    /**
     * @depends  testEntrySet
     * @param    EnumeratorAbstract
     * @return   EnumeratorAbstract
     */
    public function testEntryGet(EnumeratorAbstract $enumeratorObject)
    {
        $this->assertEquals('FF0000', $enumeratorObject->RED);
        $this->assertEquals('0000FF', $enumeratorObject->BLUE);
        $this->assertEquals('00FF00', $enumeratorObject->GREEN);
        $this->assertEquals('FFFF00', $enumeratorObject->YELLOW);
        $this->assertEquals('000000', $enumeratorObject->BLACK);

        return $enumeratorObject;
    }

    /**
     * @depends  testEntryGet
     * @param    EnumeratorAbstract
     * @return   void
     */
    public function testEntryIteration(EnumeratorAbstract $enumeratorObject)
    {
        $result = array();
        $key = 0;
        foreach ($enumeratorObject as $value) {
            $result[$key] = $value;
            $key++;
        }

        $this->assertEquals(5, count($result));
        $this->assertEquals('FF0000', $result[0]);
        $this->assertEquals('0000FF', $result[1]);
        $this->assertEquals('00FF00', $result[2]);
        $this->assertEquals('FFFF00', $result[3]);
        $this->assertEquals('000000', $result[4]);
    }

    /**
     * @depends  testEntryGet
     * @param    EnumeratorAbstract
     * @return   EnumeratorAbstract
     */
    public function testEntryRemove(EnumeratorAbstract $enumeratorObject)
    {
        $enumeratorObject->remove('RED');

        $result = array();
        $key = 0;
        foreach ($enumeratorObject as $value) {
            $result[$key] = $value;
            $key++;
        }

        $this->assertEquals(4, count($result));
        $this->assertEquals('0000FF', $result[0]);
        $this->assertEquals('00FF00', $result[1]);
        $this->assertEquals('FFFF00', $result[2]);
        $this->assertEquals('000000', $result[3]);

        return $enumeratorObject;
    }
}