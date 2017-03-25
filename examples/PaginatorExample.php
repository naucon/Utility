<?php
use Naucon\Utility\PaginatorAbstract;

// define paginator class
class YourPaginator extends PaginatorAbstract
{
    protected $_items = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    public function __construct($page = 1, $itemsPerPage = 10)
    {
        $this->setCurrentPageNumber($page);
        $this->setItemsPerPage($itemsPerPage);
    }
}

// create instance
$paginatorObject = new \YourPaginator(1, 10);

// count
echo 'Count: ' . count($paginatorObject); // Count: 21
echo '<br/>';

// iterate page 1
echo 'Page 1: ';
echo '<br/>';
foreach ($paginatorObject as $key => $value) {
    echo $value;
    echo '<br/>';
}
// Page 1:
// 1
// 2
// 3
// 4
// 5
// 6
// 7
// 8
// 9
// 10

// next page
$paginatorObject->nextPage();

// iterate page 2
echo 'Page 2: ';
echo '<br/>';
foreach ($paginatorObject as $key => $value) {
    echo $value;
    echo '<br/>';
}
// Page 2:
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

// set page
$paginatorObject->setPage(3);

// iterate page 3
echo 'Page 3: ';
echo '<br/>';
foreach ($paginatorObject as $key => $value) {
    echo $value;
    echo '<br/>';
}
// Page 3:
// 21
