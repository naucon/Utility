<?php

use Naucon\Utility\Delegate;
use Naucon\Utility\Delegator;
use Naucon\Utility\DelegateClosure;

class Foo
{
    public function fooMethod($arg1, $arg2)
    {
        echo '<br/>Foo with: ' . $arg1 . ' ' . $arg2;
    }
}

class Bar
{
    public function barMethod($arg1, $arg2)
    {
        echo '<br/>Bar with: ' . $arg1 . ' ' . $arg2;
    }
}

$delegatorObject = new Delegator();
$delegatorObject->register(new Delegate(new Foo(), 'fooMethod'));
$delegatorObject->register(new Delegate(new Bar(), 'barMethod'));


// closures require PHP5.3+
$closure = function ($arg1, $arg2) {
    echo '<br/>Closure with: ' . $arg1 . ' ' . $arg2;
};
$delegatorObject->register(new DelegateClosure($closure));

// delegate
$delegatorObject->delegate('Hallo', 'World');

//output:
//Foo with: Hallo World
//Bar with: Hallo World
//Closure with: Hallo World
