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

use Naucon\Utility\Tree;
use Naucon\Utility\TreeAbstract;
use Naucon\Utility\TreeInterface;
use Naucon\Utility\TreeNodeAbstract;
use Naucon\Utility\TreeNodeInterface;

class TreeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    TreeInterface
     */
    public function testInit()
    {
        $treeRootObject = new Tree();
        return $treeRootObject;
    }

    /**
     * @depends  testInit
     * @param    TreeInterface
     * @return   TreeInterface
     */
    public function testAdd(TreeInterface $treeRootObject)
    {
        $treeRootObject->add(new FooTree('A'));
        $treeRootObject->add(new FooTree('B'));
        $treeChildLevel1Object = $treeRootObject->add(new BarTree('C'));
        $treeChildLevel1Object->add(new FooTree('C1'));
        $treeChildLevel2Object = $treeChildLevel1Object->add(new BarTree('C2'));
        $treeChildLevel2Object->add(new FooTree('C21'));
        $treeChildLevel1Object->add(new FooTree('C3'));
        $treeRootObject->add(new FooTree('D'));

        $array = $this->buildTree($treeRootObject);

        $this->assertEquals(4, count($array));

        $this->assertEquals('A', $array[0]);
        $this->assertEquals('B', $array[1]);
        $this->assertInternalType('array', $array[2]);
        $this->assertEquals('C1', $array[2][0]);
        $this->assertInternalType('array', $array[2][1]);
        $this->assertEquals('C21', $array[2][1][0]);
        $this->assertEquals('C3', $array[2][2]);
        $this->assertEquals('D', $array[3]);

        return $treeRootObject;
    }

    /**
     * @depends  testAdd
     * @param    TreeInterface
     * @return   void
     */
    public function testCount(TreeInterface $treeRootObject)
    {
        $this->assertEquals(4, count($treeRootObject));
    }

    /**
     * @depends  testAdd
     * @param    TreeInterface
     * @return   void
     */
    public function testRemove(TreeInterface $treeRootObject)
    {
        foreach ($treeRootObject as $treeNodeObject) {
            if ($treeNodeObject->getValue() == 'B') {
                $treeRootObject->remove($treeNodeObject);
            }
        }

        $array = $this->buildTree($treeRootObject);

        $this->assertEquals(3, count($array));

        $this->assertEquals('A', $array[0]);
        $this->assertInternalType('array', $array[1]);
        $this->assertEquals('C1', $array[1][0]);
        $this->assertInternalType('array', $array[1][1]);
        $this->assertEquals('C21', $array[1][1][0]);
        $this->assertEquals('C3', $array[1][2]);
        $this->assertEquals('D', $array[2]);
    }

//    /**
//     * @depends  testAdd
//     * @param    TreeInterface
//     * @return   void
//     */
//    public function testRemoveNode(TreeInterface $treeRootObject)
//    {
//        foreach ($treeRootObject as $treeNodeObject) {
//            if ($treeNodeObject->getValue() == 'B') {
//                var_dump($treeNodeObject);
//                $treeNodeObject->removeNode();
//            }
//
//            if ($treeNodeObject->getValue() == 'C') {
//                foreach ($treeNodeObject as $treeChildNodeObject) {
//                    if ($treeChildNodeObject->getValue() == 'C2') {
//                        $treeChildNodeObject->removeNode();
//                    }
//                }
//            }
//        }
//
//        $array = $this->buildTree($treeRootObject);
//
//        $this->assertEquals(3, count($array));
//
//        $this->assertEquals('A', $array[0]);
//        $this->assertInternalType('array', $array[1]);
//        $this->assertEquals('C1', $array[1][0]);
//        $this->assertEquals('C3', $array[1][1]);
//        $this->assertEquals('D', $array[2]);
//    }

    /**
     * @param    TreeNodeInterface
     * @return   array
     */
    public function buildTree(TreeNodeInterface $treeNodeObject)
    {
        $array = array();
        if ($treeNodeObject instanceof TreeInterface) {
            foreach ($treeNodeObject as $treeChildNodeObject) {
                if ($treeChildNodeObject instanceof TreeInterface) {
                    // childs
                    if (count($treeChildNodeObject) > 0) {
                        $array[] = $this->buildTree($treeChildNodeObject);
                    } else {
                        $array[] = $treeChildNodeObject->getValue();
                    }
                } else {
                    $array[] = $treeChildNodeObject->getValue();
                }
            }
        } else {
            $array[] = $treeChildNodeObject->getValue();
        }
        return $array;
    }
}

class FooTree extends TreeNodeAbstract
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

class BarTree extends TreeAbstract
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}