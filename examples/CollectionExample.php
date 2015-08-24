<?php
use Naucon\Utility\Collection;

$collectionObject = new Collection(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));

echo 'Count: ';
echo count($collectionObject);
echo '<br/>';

echo 'Loop: ';
foreach ($collectionObject as $key => $value) {
    echo $value;
    echo ' ';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'dump array: ';
var_dump($collectionObject->toArray());
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'Contains 10: ';
if ($collectionObject->contains(10)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';

echo 'Contains 40: ';
if ($collectionObject->contains(40)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'Add 11 and 12: ';
echo '<br/>';
$collectionObject->add(11);
$collectionObject->add(12);
echo 'Count: ';
echo count($collectionObject);
echo '<br/>';

echo 'Add 13, 14, 15 and 16 as a array: ';
echo '<br/>';
$collectionObject->addAll(array(13, 14, 15, 16));
echo 'Count: ';
echo count($collectionObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'remove value: ';
echo '<br/>';
$collectionObject = new Collection(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
$collectionObject->remove(4);
$collectionObject->remove(10);
echo 'Count: ';
echo count($collectionObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'is empty (has any entries): ';
if ($collectionObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';

echo 'clear list';
$collectionObject->clear();
echo '<br/>';

echo 'is empty (has any entries): ';
if ($collectionObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';


