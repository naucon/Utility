<?php
use Naucon\Utility\CompositeAbstract;

class CompositeElement extends CompositeAbstract
{
    protected $state = null;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function __toString()
    {
        return $this->state;
    }
}

$elementAObject = new \CompositeElement('A');
$elementBObject = new \CompositeElement('B');
$elementCObject = new \CompositeElement('C');
$elementDObject = new \CompositeElement('D');
$elementEObject = new \CompositeElement('E');

$elementAObject->add($elementBObject);
$elementAObject->add($elementCObject);
$elementBObject->add($elementDObject);
$elementAObject->add($elementEObject);

//$elementAObject->remove($elementBObject);

$level = 0;
function process(\CompositeElement $elementObject, $level)
{
    $level++;
    echo $level . ': ' . $elementObject . '<br/>';
    if (count($elementObject) > 0) {
        foreach ($elementObject as $elementChildObject) {
            process($elementChildObject, $level);
        }
    }
}

process($elementAObject, $level);
