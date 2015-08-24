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

use Naucon\Utility\Delegate;
use Naucon\Utility\DelegateClosure;
use Naucon\Utility\Delegator;

class DelegateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return      Delegator
     */
    public function testInitDelegator()
    {
        $delegatorObject = new Delegator();
        $delegatorObject->register(new Delegate(new FooDelegation(), 'fooMethod'));
        $delegatorObject->register(new Delegate(new BarDelegation(), 'barMethod'));

        $closure = function ($subject) {
            $subject->foo.=' Closure';
        };

        $delegatorObject->register(new DelegateClosure($closure));

        return $delegatorObject;
    }

    /**
     * @depends     testInitDelegator
     * @param       Delegator
     * @return      void
     */
    public function testDelegate(Delegator $delegatorObject)
    {
        $subject = new \stdClass();
        $subject->foo = 'Delegator';

        $delegatorObject->delegate($subject);

        $this->assertEquals('Delegator Foo Bar Closure', $subject->foo);
    }
}

class FooDelegation
{
    public function fooMethod($subject)
    {
        $subject->foo.= ' Foo';
    }
}

class BarDelegation
{
    public function barMethod($subject)
    {
        $subject->foo.=' Bar';
    }
}