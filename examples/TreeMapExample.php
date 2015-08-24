<?php
use Naucon\Utility\TreeMap;

// init tree map
$mapObject = new TreeMap();

// mapping pair 1
$mapKey[0] = 'KeyA';
$obj = new \stdClass();
$obj->value = 'Value A';
$mapValue[0] = $obj;

// mapping pair 2
$mapKey[1] = 'KeyB';
$obj = new \stdClass();
$obj->value = 'Value B';
$mapValue[1] = $obj;

// mapping pair 3
$mapKey[2] = 'KeyC';
$obj = new \stdClass();
$obj->value = 'Value C1';
$mapValue[2][0] = $obj;
$obj = new \stdClass();
$obj->value = 'Value C2';
$mapValue[2][1] = $obj;
$obj = new \stdClass();
$obj->value = 'Value C3';
$mapValue[2][2] = $obj;

// mapping pair 4
$mapKey[3] = 'KeyD';
$obj = new \stdClass();
$obj->value = 'Value D';
$mapValue[3] = $obj;

// set 3 mappings to map
$mapObject->set($mapKey[0], $mapValue[0]);
$mapObject->set($mapKey[1], $mapValue[1]);
$mapObject->set($mapKey[2], $mapValue[2][0]);
$mapObject->set($mapKey[2], $mapValue[2][1]);
$mapObject->set($mapKey[2], $mapValue[2][2]);

// get 3 mappings from map
echo $mapObject->get($mapKey[0])->value; // 'Value A'
echo '<br/>';
echo $mapObject->get($mapKey[1])->value; // 'Value B'
echo '<br/>';
foreach ($mapObject->get($mapKey[2]) as $obj) {
    echo $obj->value; // 'Value C1', 'Value C2', 'Value C3'
    echo '<br/>';
}
echo '<br/>';

// count mappings
echo count($mapObject); // 3

// remove mapping with String 'Value B'
$mapObject->remove($mapKey[1]);

echo '<br/>';

// count mappings
echo count($mapObject); // 2

