<?php
use Naucon\Utility\HashMap;

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

// init hash map
$hashMapObject = new HashMap();

// mapping pair 1
$mapKey[] = new FooString('Key A');
$mapValue[] = new FooString('Value A');
// mapping pair 2
$mapKey[] = new FooString('Key B');
$mapValue[] = new FooString('Value B');
// mapping pair 3
$mapKey[] = new FooString('Key C');
$mapValue[] = new FooString('Value C');
// mapping pair 4
$mapKey[] = new FooString('Key D');
$mapValue[] = new FooString('Value D');

// set 3 mappings to map
$hashMapObject->set($mapKey[0], $mapValue[0]);
$hashMapObject->set($mapKey[1], $mapValue[1]);
$hashMapObject->set($mapKey[2], $mapValue[2]);

// get 3 mappings from map
echo $hashMapObject->get($mapKey[0]); // 'Value A'
echo $hashMapObject->get($mapKey[1]); // 'Value B'
echo $hashMapObject->get($mapKey[2]); // 'Value C'

echo '<br/>';

// count mappings
echo count($hashMapObject); // 3

// remove mapping with String 'Value B'
$hashMapObject->remove($mapKey[1]);

echo '<br/>';

// count mappings
echo count($hashMapObject); // 2