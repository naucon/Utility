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

use Naucon\Utility\Observable;
use Naucon\Utility\ObservableInterface;
use Naucon\Utility\ObserverAbstract;

class ObserverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var     array
     */
    static protected $observer = null;


    /**
     * method is called before test class.
     */
    static public function setUpBeforeClass()
    {
        self::$observer = array();
        self::$observer[1] = new YourObserverFoo();
        self::$observer[2] = new YourObserverBar();
    }

    /**
     * method is called after test class.
     */
    public static function tearDownAfterClass()
    {
        self::$observer = null;
    }

    /**
     * @return      YourObservableSubject
     */
    public function testInit()
    {
        // instance of observable subject
        $observableSubjectObject = new YourObservableSubject();

        // hook up observer
        $observableSubjectObject->getObservableObject()->addObserver(self::$observer[1]);
        $observableSubjectObject->getObservableObject()->addObserver(self::$observer[2]);

        return $observableSubjectObject;
    }

    /**
     * @depends     testInit
     * @param       YourObservableSubject
     * @return      void
     */
    public function testCount(YourObservableSubject $observableSubjectObject)
    {
        $this->assertEquals(2, $observableSubjectObject->getObservableObject()->countObservers());
    }

    /**
     * @depends     testInit
     * @param       YourObservableSubject
     * @return      void
     */
    public function testNotifation(YourObservableSubject $observableSubjectObject)
    {
        $observableSubjectObject->setState('start');

        $this->assertEquals(2, count($observableSubjectObject->result));

        $this->assertEquals('Foo:start', $observableSubjectObject->result[0]);
        $this->assertEquals('Bar:start', $observableSubjectObject->result[1]);

        $observableSubjectObject->setState('stop');

        $this->assertEquals(2, count($observableSubjectObject->result));

        $this->assertEquals('Foo:stop', $observableSubjectObject->result[0]);
        $this->assertEquals('Bar:stop', $observableSubjectObject->result[1]);

        $observableSubjectObject->setState('stop');

        $this->assertEquals(0, count($observableSubjectObject->result));
    }

    /**
     * @depends     testInit
     * @param       YourObservableSubject
     * @return      void
     */
    public function testRemove(YourObservableSubject $observableSubjectObject)
    {
        // remove observer
        $observableSubjectObject->getObservableObject()->removeObserver(self::$observer[1]);
        $this->assertEquals(1, $observableSubjectObject->getObservableObject()->countObservers());

        $observableSubjectObject->setState('start');

        $this->assertEquals(1, count($observableSubjectObject->result));

        $this->assertEquals('Bar:start', $observableSubjectObject->result[0]);
    }
}

class YourObservableSubject
{
    protected $observableObject = null;

    private $yourstate = null;

    public $result = null;


    public function getObservableObject()
    {
        if (is_null($this->observableObject)) {
            $this->observableObject = new Observable();
        }
        return $this->observableObject;
    }

    public function getState()
    {
        return $this->yourstate;
    }

    public function setState($value)
    {
        $this->result = array();

        if ($this->yourstate != $value) {
            $this->yourstate = $value;
            $this->getObservableObject()->setChanged();
        }
        $this->getObservableObject()->notifyObservers($this);
    }
}

class YourObserverFoo extends ObserverAbstract
{
    public function update(ObservableInterface $observableObject, $arg)
    {
        $arg->result[] = 'Foo:' . $arg->getState();
    }
}

class YourObserverBar extends ObserverAbstract
{
    public function update(ObservableInterface $observableObject, $arg)
    {
        $arg->result[] = 'Bar:' . $arg->getState();
    }
}