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

use Naucon\Utility\Composite;
use Naucon\Utility\CompositeAbstract;

class CompositeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    CompositeAbstract
     */
    public function testInit()
    {
        $elementObject = new CompositeElement('A');
        $elementBObject = new CompositeElement('B');
        $elementCObject = new CompositeElement('C');
        $elementDObject = new CompositeElement('D');
        $elementEObject = new CompositeElement('E');

        $elementObject->add($elementBObject); // B to A
        $elementObject->add($elementCObject); // C to A
        $elementBObject->add($elementDObject); // D to B
        $elementObject->add($elementEObject); // E to A

        return $elementObject;
    }

    /**
     * @param    array
     * @param    CompositeAbstract
     * @return   void
     */
    public function buildTree(CompositeAbstract $elementObject)
    {
        $array = array();
        foreach ($elementObject as $elementChildObject) {
            // childs
            if (count($elementChildObject) > 0) {
                $array[] = $this->buildTree($elementChildObject);
            } else {
                $array[] = (string)$elementChildObject;
            }
        }
        return $array;
    }

    /**
     * @depends  testInit
     * @param    CompositeAbstract
     * @return   void
     */
    public function testTree(CompositeAbstract $elementObject)
    {
        $this->assertEquals(3, count($elementObject));

        $array = $this->buildTree($elementObject);

        $this->assertEquals(3, count($array));

        $this->assertInternalType('array', $array[0]);
        $this->assertEquals('D', $array[0][0]);

        $this->assertEquals('C', $array[1]);
        $this->assertEquals('E', $array[2]);
    }

    /**
     * @depends  testInit
     * @param    CompositeAbstract
     * @return   void
     */
    public function testRemove(CompositeAbstract $elementObject)
    {
        $removed = false;
        foreach ($elementObject as $elementChildObject) {
            if ($elementChildObject->__toString() == 'B') {
                $elementObject->remove($elementChildObject);
                $removed = true;
            }
        }

        $this->assertTrue($removed);

        $this->assertEquals(2, count($elementObject));

        $array = $this->buildTree($elementObject);

        $this->assertEquals(2, count($array));

        $this->assertEquals('C', $array[0]);
        $this->assertEquals('E', $array[1]);
    }
}


class CompositeElement extends CompositeAbstract
{
    protected $state = null;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function __toString()
    {
        return $this->state;
    }
}