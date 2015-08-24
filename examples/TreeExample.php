<?php
use Naucon\Utility\TreeNodeAbstract;
use Naucon\Utility\TreeInterface;
use Naucon\Utility\TreeAbstract;
use Naucon\Utility\Tree;

class FooTree extends TreeNodeAbstract
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

class BarTree extends TreeAbstract
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

$fooObj1 = new \FooTree('A');
$fooObj2 = new \FooTree('B');

$treeRootObject = new Tree();

echo 'add Tree: <br/>';
echo 'A <br/>';
$treeRootObject->add($fooObj1);
echo 'B <br/>';
$treeRootObject->add($fooObj2);
echo 'C <br/>';
$treeChildLevel1Object = $treeRootObject->add(new \BarTree('C'));
echo 'C - C1 <br/>';
$treeChildLevel1Object->add(new \FooTree('C1'));
echo 'C - C2 <br/>';
$treeChildLevel2Object = $treeChildLevel1Object->add(new \BarTree('C2'));
echo 'C - C2 - C21 <br/>';
$treeChildLevel2Object->add(new \FooTree('C21'));
echo 'C - C3 <br/>';
$treeChildLevel1Object->add(new \FooTree('C3'));
echo 'D <br/>';
$treeRootObject->add(new \FooTree('D'));
echo '<br/>';
echo '<br/>';
echo '<br/>';

echo 'count: ';
echo count($treeRootObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'loop: <br/>';
foreach ($treeRootObject as $treeNodeObject) {
    echo $treeNodeObject->getValue();
    echo '<br/>';

    if ($treeNodeObject instanceof TreeInterface) {
        foreach ($treeNodeObject as $treeChildNodeObject) {
            echo $treeNodeObject->getValue() . ' - ' . $treeChildNodeObject->getValue();
            echo '<br/>';

            if ($treeChildNodeObject instanceof TreeInterface) {
                foreach ($treeChildNodeObject as $treeChild2NodeObject) {
                    echo $treeNodeObject->getValue() . ' - ' . $treeChildNodeObject->getValue() . ' - ' . $treeChild2NodeObject->getValue();
                    echo '<br/>';
                }
            }
        }
    }
}
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo 'remove B: ';
/*foreach ($treeRootObject as $treeNodeObject) {
    if ($treeNodeObject->getValue() == 'B') {
        $treeRootObject->remove($treeNodeObject);
    }
}*/
$treeRootObject->remove($fooObj2);
echo 'count: ';
echo count($treeRootObject);
echo '<br/>';
echo '<br/>';
echo '<br/>';

