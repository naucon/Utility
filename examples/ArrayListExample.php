<?php
use Naucon\Utility\ArrayList;

$listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10) );

echo 'Count: ';
echo count($listObject);
echo '<br/>';

echo 'Loop: ';
foreach ($listObject as $key => $value) {
    echo $value;
    echo ' ';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';



echo 'dump array: ';
var_dump($listObject->toArray());
echo '<br/>';
echo '<br/>';
echo '<br/>';



echo 'Contains 10: ';
if ($listObject->contains(10)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';

echo 'Contains 40: ';
if ($listObject->contains(40)) {
    echo 'TRUE';
} else {
    echo 'FALSE';
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'Get Entry by index: ';
echo '<br/>';
echo 'Range from ' . $listObject->get(0) . ' to ' . $listObject->get(9);
echo '<br/>';
echo '<br/>';
echo '<br/>';



echo 'Add 11 and 12: ';
echo '<br/>';
$listObject->add(11);
$listObject->add(12);
echo 'Count: ';
echo count($listObject);
echo '<br/>';

echo 'Add 13, 14, 15 and 16 as a array: ';
echo '<br/>';
$listObject->addAll(array(13, 14, 15, 16));
echo 'Count: ';
echo count($listObject);
echo '<br/>';

echo 'Add 17 and 18 with index: ';
echo '<br/>';
$listObject->addWithIndex(16, 17);
$listObject->addWithIndex(17, 18);
echo 'Count: ';
echo count($listObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';



echo 'Set with index: ';
echo '<br/>';
$listObject->set(18, 19);
$listObject->set(10, 99);
echo 'Count: ';
echo count($listObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';




echo 'remove value: ';
echo '<br/>';
$listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10) );
$listObject->remove(4);
$listObject->remove(10);
$listObject->remove(15);
echo 'Count: ';
echo count($listObject);
echo '<br/>';


echo 'remove index: ';
echo '<br/>';
$listObject = new ArrayList(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12) );
$listObject->removeIndex(4);
$listObject->removeIndex(10);
$listObject->removeIndex(15);
echo 'Count: ';
echo count($listObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';



echo 'is empty (has any entries): ';
if ($listObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';

echo 'clear list';
$listObject->clear();
echo '<br/>';

echo 'is empty (has any entries): ';
if ($listObject->isEmpty()) {
    echo 'FALSE';
} else {
    echo 'TRUE';
}
echo '<br/>';

