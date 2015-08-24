<?php
use Naucon\Utility\HashSet;
use Naucon\Utility\Exception\HashSetException;

$setObject = new HashSet();
$setObject->addAll(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));

echo 'count: ';
echo count($setObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'iteration: ';
foreach ($setObject as $key => $value) {
    echo $value;
    echo '';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'dump to array: ';
var_dump($setObject->toArray());
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'Contains 10: ';
if ($setObject->contains(10)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';
echo 'Contains 40: ';
if ($setObject->contains(40)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'Add 11 and 12: ';
echo '<br/>';
$setObject->add(11);
$setObject->add(12);
echo 'Count: ';
echo count($setObject);
echo '<br/>';


echo 'Add duplicate value (11): ';
echo '<br/>';
try {
    $setObject->add(11);
} catch (HashSetException $exception) {
    echo ' > Exception!<br/>';
}
echo 'Count: ';
echo count($setObject);
echo '<br/>';

echo 'Add Array (13,14,15,16): ';
echo '<br/>';
$setObject->addAll(array(13, 14, 15, 16));
echo 'Count: ';
echo count($setObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';

echo 'Add duplicate Array (17,11,12,18): ';
echo '<br/>';
try {
    $setObject->addAll(array(17, 11, 12, 18)); // 11 and 12 are duplicate elements
} catch (HashSetException $exception) {
    echo ' > Exception!<br/>';
}
echo 'Count: ';
echo count($setObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'remove value: ';
echo '<br/>';
$setObject = new HashSet();
$setObject->addAll(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
$setObject->remove(4);
$setObject->remove(10);
echo 'Count: ';
echo count($setObject);
echo '<br/>';


echo 'is empty (has any entries): ';
if ($setObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';

echo 'clear set';
$setObject->clear();
echo '<br/>';

echo 'is empty (has any entries): ';
if ($setObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';

