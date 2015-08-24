<?php
use Naucon\Utility\Map;

class FooString
{
    protected $value = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}

// init map
$mapObject = new Map();

// mapping pair 1
$mapKey[] = 'KeyA';
$mapValue[] = new FooString('Value A');
// mapping pair 2
$mapKey[] = 'KeyB';
$mapValue[] = new FooString('Value B');
// mapping pair 3
$mapKey[] = 'KeyC';
$mapValue[] = new FooString('Value C');
// mapping pair 4
$mapKey[] = 'KeyD';
$mapValue[] = new FooString('Value D');

// set 3 mappings to map
$mapObject->set($mapKey[0], $mapValue[0]);
$mapObject->set($mapKey[1], $mapValue[1]);
$mapObject->set($mapKey[2], $mapValue[2]);

// get 3 mappings from map
echo $mapObject->get($mapKey[0]); // 'Value A'
echo $mapObject->get($mapKey[1]); // 'Value B'
echo $mapObject->get($mapKey[2]); // 'Value C'

echo '<br/>';

// count mappings
echo count($mapObject); // 3

// remove mapping with String 'Value B'
$mapObject->remove($mapKey[1]);

echo '<br/>';

// count mappings
echo count($mapObject); // 2
