<?php
use Naucon\Utility\Iterator;

$array = array();
$array[] = 'foo';
$array[] = 'bar';

$iteratorObject = new Iterator($array);

var_dump($iteratorObject);
echo '<br/>';

// iterate
foreach ($iteratorObject as $key => $value) {
    echo '<br/>';
    echo $key . ' -> ' . $value;
}
echo '<br/>';

// count
echo 'Count: ' . count($iteratorObject);
echo '<br/>';