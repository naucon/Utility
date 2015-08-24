# naucon Utility Package

## About

This package contains miscellaneous php interfaces and classes to structure and organize data as well as groups of objects.


### Features

* Iterator
    * Iterable
    * IteratorReverse
    * IteratorLimit
    * Paginator
* IteratorDecoratorAbstract
    * IteratorDecoratorReverse
    * IteratorDecoratorLimit
    * PaginatorDecorator
* Collection
    * CollectionDecorator
* ArrayList
* Map
    * HashMap
    * TreeMap
* Set
    * HashSet
* Tree
* Enumerator
* Composite


## Acknowledgements

This package is inspired by java.util package. The concepts has been adjusted to the PHP world.


### Compatibility

* PHP5.3


## Installation

install the latest version via composer 

    composer require naucon/utility


## Basic Usage

### Iterator

`Iterator` extends `IteratorAbstract`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `Iterator` class holds data in a internal array. The class can be iterated with the `foreach()` command to retrieve the data from the array.
It also provides the following methods to cycle and count data: `isFirst()`, `isLast()`, `current()`, `next()`, `hasNext()`, `previous()`, `hasPrevious()`, `first()`, `last()`, `rewind()`, `key()`, `indexOf()`, `hasIndex()`, `setItemPosition()`, `count()`.
The class implements the `Iterator` and `Countable` interface of PHP.

In contrast to the `Collection` or the `ArrayList` the `Iterator` is only can retrieve data it can not add them. Also it has no control of its index.

    $array = array();
    $array[] = 'foo';
    $array[] = 'bar';

    // create instance
    use Naucon\Utility\Iterator;
    $iteratorObject = new Iterator($array);

    // count
    echo count($iteratorObject); // output: 2

    // iterate
    foreach ($iteratorObject as $key => $value) {
        echo $value . ' ';
    }
    // output: foo bar


### Iterable

`Iterable` extends `IterableAbstract`
`IterableAbstract` implements `IterableInterface`
`IterableInterface` extends `IteratorAggregate`, `Countable`

The `Iterable` class works like the `Iterator` class. Instead of a array it holds the data in a internal `Iterator` instance.
Without any methodes to cycle data the class can be iterated with the `foreach()` command. To count data it provides the methode `count()`.
The internal `Iterator` can be accessed through the method `getIterator()`.
The class implements the `IteratorAggregate` and `Countable` interface.

    // create instance
    use Naucon\Utility\Iterable;
    use Naucon\Utility\Iterator;
    $iterableObject = new Iterable(new Iterator(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10)));

    // count
    echo count($iterableObject); // output: 10

    // iterate
    foreach ($iterableObject as $key => $value) {
        echo $value . '';
    }
    // output: 1 2 3 4 5 6 7 8 9 10

### IteratorReverse

`IteratorReverse` extends `IteratorReverseAbstract`
`IteratorReverseAbstract` extends `IteratorAbstract`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

Based on the `Iterator` the `IteratorReverse` class reverse the order of the returned items.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    // create instance
    use Naucon\Utility\IteratorReverse;
    $iteratorObject = new IteratorReverse($array);

    // count
    echo count($iteratorObject); // Output: 10

    // iterate
    foreach ($iteratorObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 10 9 8 7 6 5 4 3 2 1



### IteratorLimit

`IteratorLimit` extends `IteratorLimitAbstract`
`IteratorLimitAbstract` extends `IteratorAbstract` implements `IteratorLimitInterface`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

Based on the `Iterator` the `IteratorLimit` class retrieve a subset of the data by a given `offset` and `count` parameter.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    // create instance
    use Naucon\Utility\IteratorLimit;
    $iteratorObject = new IteratorLimit($array, 10, 10); // offset=10, count=10

    // count
    echo count($iteratorObject); // Output: 21

    // iterate
    foreach ($iteratorObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 11 12 13 14 15 16 17 18 19 20


### Paginator

`Paginator` extends `PaginatorAbstract`
`PaginatorAbstract` extends `IteratorLimitAbstract` implements `PaginatorInterface`
`IteratorLimitAbstract` extends `IteratorAbstract` implements `IteratorLimitInterface`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

Based on the `IteratorLimit` the `Paginator` class devise the data into pages by a given `itemsPerPage` parameter.
It also provides the following methods to control pages: `getCurrentPageNumber()`, `setPage()`, `nextPage()`, `countPages()`, `isFirstPage()`, `isLastPage()`, `hasNextPage()`, `hasPreviousPage()`, `getNextPageNumber()`, `getPreviousPageNumber()`.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    // create instance
    use Naucon\Utility\Paginator;
    $paginatorObject = new Paginator($array, 10);

    // count
    echo count($paginatorObject); // Output: 21

    // iterate page 1
    foreach ($paginatorObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 1 2 3 4 5 6 7 8 9 10

    // next page
    $paginatorObject->nextPage();

    // iterate page 2
    foreach ($paginatorObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 11 12 13 14 15 16 17 18 19 20

    // set a certain page
    $paginatorObject->setPage(3);

    // iterate page 3
    foreach ($paginatorObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 21


### IteratorDecoratorAbstract

`IteratorDecoratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `IteratorDecoratorAbstract` is a abstract class. Like the `Iterable` class it holds the data in a internal `Iterator` instance.
Instead of the `Iterable` it implements every method of the `IteratorInterface` to be completely compatible to a normal `Iterator`.

His purpose is to create a abstraction layer between `Iterator` and a individual implementation.

For example the `Paginator` and `IteratorLimit` can't modify the same data or instance. Because they are individual implementations of the `IteratorInterface`.
Which a decorator you can modify any `Iterator` instance a often as you like.

As you can guess it is the basement of the `IteratorDecoratorReverse`, `IteratorDecoratorLimit` and `PaginatorDecorator` class.


### IteratorDecoratorReverse

`IteratorDecoratorReverse` extends `IteratorDecoratorAbstract`
`IteratorDecoratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `IteratorDecoratorReverse` class is a decorator for any instance of `IteratorInterface`. The Decorator reverse the order of the returned items.
It have the same methods as the `IteratorLimit` class.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    // create instance
    use Naucon\Utility\Iterator;
    use Naucon\Utility\IteratorDecoratorReverse;
    $iteratorLimitObject = new IteratorDecoratorReverse(new Iterator($array));




### IteratorDecoratorLimit

`IteratorDecoratorLimit` extends `IteratorDecoratorAbstract`
`IteratorDecoratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `IteratorDecoratorLimit` class is a decorator for any instance of `IteratorInterface`. The Decorator retrieve a subset of the data by a given `offset` and `count` parameter.
It have the same methods as the `IteratorLimit` class.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    // create instance
    use Naucon\Utility\Iterator;
    use Naucon\Utility\IteratorDecoratorLimit;
    $iteratorLimitObject = new IteratorDecoratorLimit(new Iterator($array), 0, 10);


### PaginatorDecorator

`PaginatorDecorator` extends `IteratorDecoratorLimit` implements `PaginatorInterface`
`IteratorDecoratorLimit` extends `IteratorDecoratorAbstract`
`IteratorDecoratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `PaginatorDecorator` class is a decorator for any instance of `IteratorInterface`. The Decorator devise the data into pages by a given `itemsPerPage` parameter.
It have the same methods as the `Paginator` class.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

    // create instance
    use Naucon\Utility\Iterator;
    use Naucon\Utility\PaginatorDecorator;
    $paginatorObject = new PaginatorDecorator(new Iterator($array), 10);


### Collection

`Collection` extends `CollectionAbstract`
`CollectionAbstract` extends `IterableAbstract` implements `CollectionInterface`
`IterableAbstract` implements `IterableInterface`
`IterableInterface` extends `IteratorAggregate`, `Countable`

The `Collection` class holds, add and remove data in a internal array. Also it implements the `IterableInterface` to iterated the data with the `foreach()` command.

In contrast to the `Iterator` or `Iterable` the `Collection` can retrieve, add and remove data. But he also has no control of the index.

It provides the following methods to  add and count data: `add()`, `addAll()`, `clear()`, `contains()`, `isEmpty()`, `getIterator()`, `remove()`, `count()`, `toArray()`.
The class implements the `IteratorAggregate` and `Countable` interface of PHP.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    // create instance
    use Naucon\Utility\Collection;
    $collectionObject = new Collection($array);

    // count
    echo count($collectionObject); // Output: 10

    // iterate
    foreach ($collectionObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 1 2 3 4 5 6 7 8 9 10


    // dump data to a array
    var_dump($collectionObject->toArray());
    // Output: array(10) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) [7]=> int(8) [8]=> int(9) [9]=> int(10) }


    // contains value of 10
    if ($collectionObject->contains(10)) {
        echo 'TRUE';
    } else {
        echo 'FALSE';
    }
    // Output: TRUE

    // contains value of 40
    if ($collectionObject->contains(40)) {
        echo 'TRUE';
    } else {
        echo 'FALSE';
    }
    // Output: FALSE


    // add data
    $collectionObject->add(11);

    // add array of data
    $collectionObject->addAll(array(12, 13, 14, 15, 16));

    // remove data
    $collectionObject->remove(4);

    // remove all data
    $collectionObject->clear();


### CollectionDecorator

`CollectionDecorator` extends `CollectionDecoratorAbstract`
`CollectionDecoratorAbstract` implements `CollectionInterface`
`CollectionInterface` extends `IterableInterface`
`IterableInterface` extends `IteratorAggregate`, `Countable`

The `CollectionDecorator` is a abstract class. Like the `IteratorDecoratorAbstract` class it holds the data in a internal `Collection` instance.
It implements every method of the `CollectionInterface` to be completely compatible to a normal `Collection`.

His purpose is to create a abstraction layer between `Collection` and a individual implementation.


### ArrayList

`ArrayList` extends `ListAbstract`
`ListAbstract` extends `CollectionAbstract` implements `ListInterface`
`CollectionAbstract` extends `IterableAbstract` implements `CollectionInterface`
`IterableAbstract` implements `IterableInterface`
`IterableInterface` extends `IteratorAggregate`, `Countable`

The `ArrayList` class holds, add and remove data in a internal array with a individual index. Also it implements the `CollectionInterface` and therefore the `IterableInterface` to iterated the data with the `foreach()` command.

In contrast to the `Collection` he has control of the index.

It provides the following methods to  add and count data: `add()`, `addWithIndex()`,  `addAll()`, `get()`, `hasIndex()`, `removeIndex()`, `set()`, `clear()`, `contains()`, `isEmpty()`, `getIterator()`, `remove()`, `count()`, `toArray()`.
The class implements the `IteratorAggregate` and `Countable` interface of PHP.

    $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    // create instance
    use Naucon\Utility\ArrayList;
    $listObject = new ArrayList($array);

    // count
    echo count($listObject); // Output: 10

    // iterate
    foreach ($listObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 1 2 3 4 5 6 7 8 9 10


    // dump data to a array
    var_dump($listObject->toArray());
    // Output: array(10) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) [7]=> int(8) [8]=> int(9) [9]=> int(10) }


    // get entry by index
    echo $listObject->get(0); // Output: 1
    echo $listObject->get(9); // Output: 10


    // add data
    $listObject->add(11);

    // add array of data
    $listObject->addAll(array(12, 13, 14, 15, 16));

    // add data with index
    $listObject->addWithIndex(16, 17);
    $listObject->addWithIndex(17, 18);
    $listObject->set(18, 19);
    $listObject->set(10, 99);

    // remove data by value
    $listObject->remove(4);

    // remove data by index
    $listObject->removeIndex(0);

    // remove all data
    $listObject->clear();


### Map

`Map` extends `MapAbstract`
`MapAbstract` implements `MapInterface`
`MapInterface` extends `Countable`

The `Map` class holds, add and remove key-value pairs of data in a internal array. In contrast to the `Iterator` and `Collection` classes it can not interate data with the `foreach()` command.

A key in a `Map` can only be used once. when adding a key-value pair with a existing key it will overwrite the existing key-value pair.
That is the main difference to the `Set` class.

It provides the following methods to add and remove key-value pairs: `hasKey()`, `hasValue()`,  `get()`, `getAll()`, `set()`, `setAll()`, `set()`, `remove()`, `clear()`, `count()`.
The class implements the `Countable` interface of PHP.

    // create instance
    use Naucon\Utility\Map;
    $mapObject = new Map();

    // key-value pair 1
    $mapKey[] = 'KeyA';
    $mapValue[] = 'Value A';

    // key-value pair 2
    $mapKey[] = 'KeyB';
    $mapValue[] = 'Value B';

    // key-value pair 3
    $mapKey[] = 'KeyC';
    $mapValue[] = 'Value C';

    // add key-value-pairs to map
    $mapObject->set($mapKey[0], $mapValue[0]);
    $mapObject->set($mapKey[1], $mapValue[1]);
    $mapObject->set($mapKey[2], $mapValue[2]);

    // get key-value-pairs from map
    echo $mapObject->get($mapKey[0]); // Output: Value A
    echo $mapObject->get($mapKey[1]); // Output: Value B
    echo $mapObject->get($mapKey[2]); // Output: Value C

    // count key-value-pairs
    echo count($mapObject); // Output: 3

    // remove key-value pair with 'Value B'
    $mapObject->remove($mapKey[1]);


### HashMap

`HashMap` extends `HashMapAbstract`
`HashMapAbstract` extends `MapAbstract` implements `HashMapInterface`
`MapAbstract` implements `MapInterface`
`MapInterface` extends `Countable`

Based on the `Map` the `HashMap` add and remove key-value pairs in the same way as the `Map` class do.
In contrast to the `Map` class the key in an `HashMap` can also be a instance of an object. The `HashMap` converts the instance with the `spl_object_hash()` function to a hash key.
Because the key is converted to a hash the `HashMap` can not return it original form (object). But values can be added, removed and returned by a given instance.

It provides the following methods to add and remove key-value pairs: `hasKey()`, `hasValue()`,  `get()`, `getAll()`, `set()`, `setAll()`, `set()`, `remove()`, `clear()`, `count()`.
The class implements the `Countable` interface of PHP.


### TreeMap

`TreeMap` extends `TreeMapAbstract`
`TreeMapAbstract` extends `Map` implements `MapInterface`
`Map` extends `MapAbstract`
`MapAbstract` implements `MapInterface`
`MapInterface` extends `Countable`

The `TreeMap` class works like the `Map` Class. It holds, add and remove key-value pairs of data in a internal array.

A contrast to a a `Map` the `TreeMap` can add multiple value to one key.

It provides the following methods to add and remove key-value pairs: `hasKey()`, `hasValue()`,  `get()`, `getAll()`, `set()`, `setAll()`, `set()`, `remove()`, `clear()`, `count()`.
The class implements the `Countable` interface of PHP.

    // create instance
    use Naucon\Utility\TreeMap;
    $mapObject = new TreeMap();

    // key-value pair 1
    $mapKey[0] = 'KeyA';
    $mapValue[0] = 'Value A';

    // key-value pair 2
    $mapKey[1] = 'KeyB';
    $mapValue[1] = 'Value B';

    // key-value pair 3
    $mapKey[2] = 'KeyC';
    $mapValue[2][0] = 'Value C1';
    $mapValue[2][1] = 'Value C2';
    $mapValue[2][2] = 'Value C3';

    // add key-value pairs to map
    $mapObject->set($mapKey[0], $mapValue[0]);
    $mapObject->set($mapKey[1], $mapValue[1]);
    $mapObject->set($mapKey[2], $mapValue[2][0]);
    $mapObject->set($mapKey[2], $mapValue[2][1]);
    $mapObject->set($mapKey[2], $mapValue[2][2]);

    // get key-value pairs from map
    echo $mapObject->get($mapKey[0]); // Output: Value A
    echo $mapObject->get($mapKey[1]); // Output: Value B
    foreach ($mapObject->get($mapKey[2]) as $value) {
        echo $value . ' ';
    }
    // Output: Value C1 Value C2 Value C3'

    // count key-value-pairs
    echo count($mapObject); // Output: 3

    // remove key-value with 'Value B'
    $mapObject->remove($mapKey[1]);


### Set

`Set` extends `SetAbstract`
`SetAbstract` extends `CollectionAbstract`
`CollectionAbstract` extends `IterableAbstract` implements `CollectionInterface`
`IterableAbstract` implements `IterableInterface`

The `Set` class works like the `Collection` Class. It holds, add and remove data in a internal array.
A existing value can only added once. Also data can be interated throught the `foreach()` command.

It provides the following methods to retrieve, add and remove data: `add()`, `addAll()`,  `clear()`, `contains()`, `isEmpty()`, `getIterator()`, `remove()`, `count()`, `toArray()`.
The class implements the `IteratorAggregate` and `Countable` interface of PHP.

    // create instance
    use Naucon\Utility\Set;
    $setObject = new Set();
    $setObject->addAll(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));

    // count
    echo count($setObject); // Output: 10

    // iterate
    foreach ($setObject as $key => $value) {
        echo $value . ' ';
    }
    // Output: 1 2 3 4 5 6 7 8 9 10


    // dump data to a array
    var_dump($setObject->toArray());
    // Output: array(10) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) [7]=> int(8) [8]=> int(9) [9]=> int(10) }


    // contains value of 10
    if ($setObject->contains(10)) {
        echo 'TRUE';
    } else {
        echo 'FALSE';
    }
    // Output: TRUE

    // contains value of 40
    if ($setObject->contains(40)) {
        echo 'TRUE';
    } else {
        echo 'FALSE';
    }
    // Output: FALSE


    // add data
    $setObject->add(11);    // return true

    // add array of data
    $setObject->addAll(array(12, 13, 14, 15, 16));

    // add duplicate data   // return false
    $setObject->add(11);

    // remove data
    $setObject->remove(4);

    // remove all data
    $setObject->clear();


### HashSet

`HashSet` extends `HashSetAbstract`
`HashSetAbstract` extends `SetAbstract` implements `HashSetInterface`
`SetAbstract` extends `CollectionAbstract`
`CollectionAbstract` extends `IterableAbstract` implements `CollectionInterface`
`IterableAbstract` implements `IterableInterface`

Based on the `Set` the `HashSet` hold, add and remove data in the same way as the `Set` class do.
In contrast to the `Set` class the key in an `HashSet` is a hash of its value. The `HashSet` converts a given instance of an value with the `spl_object_hash()` function to a hash key.

Like the `Set` class a existing value can only added once. Also data can be interated throught the `foreach()` command.

It provides the following methods to add and remove key-value pairs: `add()`, `addAll()`,  `clear()`, `contains()`, `isEmpty()`, `getIterator()`, `remove()`, `count()`, `toArray()`.
The class implements the `IteratorAggregate` and `Countable` interface of PHP.


### Tree

`Tree` extends `TreeAbstract`
`TreeAbstract` extends `TreeNodeAbstract` implements `TreeInterface`
`TreeNodeAbstract` implements `TreeNodeInterface`
`TreeInterface` extends `TreeNodeInterface`, `IterableInterface`
`IterableInterface` extends `IteratorAggregate`, `Countable`

The `Tree` class holds hierarchical structure data in a internal `HashSet`. The class can be iterated with the `foreach()` command to retrieve the data from the `HashSet`.
It also provides the following methods to retrieve, add, remove data: `getIterator()`, `hasChilds()`, `count()`, `add()`, `addChild()`, `removeChild()`, `hasParent()`, `getParent()`, `removeNode()`, `rewind()`, `key()`, `indexOf()`, `hasIndex()`, `setItemPosition()`, `count()`.
The class implements the `IteratorAggregate` and `Countable` interface of PHP.

In contrast to the `Iterable`, `Iterator` or `Collection` the `Tree` only works with instances of `TreeNodeInterface`.

    // create instance
    use Naucon\Utility\TreeNodeAbstract;
    use Naucon\Utility\TreeInterface;
    use Naucon\Utility\TreeAbstract;
    use Naucon\Utility\Tree;
    $treeRootObject = new Tree();

    // declare a simple tree node class
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

    // declare another simple tree node class
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

    // create instance of tree nodes
    $fooObj1 = new \FooTree('A');
    $fooObj2 = new \FooTree('B');

    // add a nodes A and B to tree
    $treeRootObject->add($fooObj1);
    $treeRootObject->add($fooObj2);

    // add a tree C to tree
    $treeChildLevel1Object = $treeRootObject->add(new \BarTree('C')); // add() returns a instance of the `TreeNode`

    // add a node C1 to node C
    $treeChildLevel1Object->add(new \FooTree('C1'));

    // add a node C2 to node C
    $treeChildLevel2Object = $treeChildLevel1Object->add(new \BarTree('C2'));

    // add a node C21 to node C2
    $treeChildLevel2Object->add(new \FooTree('C21'));

    // add a node C3 to node C
    $treeChildLevel1Object->add(new \FooTree('C3'));

    // add a node D to tree
    $treeRootObject->add(new \FooTree('D'));


    // count
    echo count($treeRootObject); // Output: 4


    // iterate
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
    // Output:
    // A
    // B
    // C
    // C - C1
    // C - C2
    // C - C2 - C21
    // C - C3
    // D


    // remove tree node from tree
    $treeRootObject->remove($fooObj2);


### Enumerator

`Enumerator` extends `EnumeratorAbstract`
`EnumeratorAbstract` extends `IteratorAbstract` implements `EnumeratorInterface`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `Enumerator` class provides a easy way to retrieve, add and interated key-value-pairs of data. The class can be iterated with the `foreach()` command.
It also provides the following methods to retrieve, add and remove key-value pairs of data: `set()`, `remove()`, `isFirst()`, `isLast()`, `current()`, `next()`, `hasNext()`, `previous()`, `hasPrevious()`, `first()`, `last()`, `key()`, `valid()`, `rewind()`, `hasIndex()`, `indexOf()`, `setItemPosition()`, `count()`.
The class implements the `Iterator` and `Countable` interface.

    // create instance
    use Naucon\Utility\Enumerator;
    $enumeratorObject1 = new Enumerator('RED', 'BLUE', 'GREEN', 'YELLOW', 'BLACK');

    echo 'My favorite color is ' . $enumeratorObject1->RED;
    // Output: My favorite color is RED

    // iterate
    foreach ($enumeratorObject1 as $key => $value) {
        echo $value . ' ';
    }
    // Output: RED BLUE GREEN YELLOW BLACK


    // create another instance
    $enumeratorObject2 = new Enumerator();

    // add enumeration
    $enumeratorObject2->set('FF0000', 'RED');
    $enumeratorObject2->set('0000FF', 'BLUE');
    $enumeratorObject2->set('00FF00', 'GREEN');
    $enumeratorObject2->set('FFFF00', 'YELLOW');
    $enumeratorObject2->set('000000', 'BLACK');

    echo 'HEX color code of RED is #' . $enumeratorObject2->RED;
    // Output: HEX color code of RED is #FF0000


    // create another instance
    $enumeratorObject3 = new Enumerator();

    // add enumeration
    $enumeratorObject3->RED = 'FF0000';
    $enumeratorObject3->BLUE = '0000FF';
    $enumeratorObject3->GREEN = '00FF00';
    $enumeratorObject3->YELLOW = 'FFFF00';
    $enumeratorObject3->BLACK = '000000';

    echo 'HEX color code of RED is #' . $enumeratorObject3->RED;
    // Output: HEX color code of RED is #FF0000


    // create another instance
    $enumeratorObjectParent = new Enumerator();

    // add enumeration
    $enumeratorObjectParent->COLOR = $enumeratorObject3;    // add a enumeration instance
    $enumeratorObjectParent->FOO = 'bar';

    echo 'HEX color code of RED is #' . $enumeratorObjectParent->COLOR->RED . '<br/>';
    // Output: HEX color code of RED is #FF0000

    // iterate
    foreach ($enumeratorObjectParent as $key => $value) {
        if ($value instanceof Enumerator) {
            echo $key . ' ';
            foreach ($value as $value2) {
                echo $value2 . ' ';
            }
        } else {
            echo (string)$value . ' ';
        }
    }
    // Output: COLOR FF0000 0000FF 00FF00 FFFF00 000000 bar

### Composite

`Composite` extends `CompositeAbstract`
`CompositeAbstract` extends `IteratorAbstract` implements `CompositeElementInterface`
`IteratorAbstract` implements `IteratorInterface`
`IteratorInterface` extends `Iterator`, `Countable`

The `Composite` class holds hierarchical structure data in a internal array similar to the `Tree` class. The class can be iterated with the `foreach()` command to retrieve the child elements.
It also provides the following methods to retrieve, add, remove data: `add()`, `remove()`, `isFirst()`, `isLast()`, `current()`, `next()`, `hasNext()`, `previous()`, `hasPrevious()`, `first()`, `last()`, `key()`, `valid()`, `rewind()`, `indexOf()`, `setItemPosition()`, `count()`.
The class implements the `Iterator` and `Countable` interface of PHP.

In contrast to the `Tree` class the composite has no root element. Every element is equal to each other.

The elements have to be a instances of `CompositeElementInterface`.

    use Naucon\Utility\CompositeAbstract;

    // declare simple composite element class
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

    // create element instances
    $elementAObject = new \CompositeElement('A');
    $elementBObject = new \CompositeElement('B');
    $elementCObject = new \CompositeElement('C');
    $elementDObject = new \CompositeElement('D');
    $elementEObject = new \CompositeElement('E');

    // add elements
    $elementAObject->add($elementBObject); // B to A
    $elementAObject->add($elementCObject); // C to A
    $elementBObject->add($elementDObject); // D to B
    $elementAObject->add($elementEObject); // E to A

    // iterate
    foreach ($elementAObject as $elementChildObject) {
        echo (string)$elementChildObject . ' '; // call __toString() method
    }
    // Output: B C E

    // remove element
    //$elementAObject->remove($elementBObject);


## License

The MIT License (MIT)

Copyright (c) 2015 Sven Sanzenbacher

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.







