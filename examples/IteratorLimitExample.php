<?php
use Naucon\Utility\IteratorLimitAbstract;

// define iterator class
class YourIterator extends IteratorLimitAbstract
{
    protected $_items = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    public function __construct($offset = 0, $count = 50)
    {
        $this->setItemOffset($offset);
        $this->setItemCount($count);
    }
}

// create instance
$iteratorObject = new \YourIterator(10, 10);

// count
echo 'Count: ' . count($iteratorObject); // Count: 21
echo '<br/>';

// iterate
echo 'Iterate: ';
echo '<br/>';
foreach ($iteratorObject as $key => $value) {
    echo $value;
    echo '<br/>';
}

// Iterate:
// 11
// 12
// 13
// 14
// 15
// 16
// 17
// 18
// 19
// 20