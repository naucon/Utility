<?php
use Naucon\Utility\Enumerator;

$enumeratorObject1 = new Enumerator('RED', 'BLUE', 'GREEN', 'YELLOW', 'BLACK');

echo 'My favorite color is ' . $enumeratorObject1->RED . '<br/>'; // My favorite color is RED

foreach ($enumeratorObject1 as $key => $value) {
    echo $value . '<br/>';
}
// RED<br/>
// BLUE<br/>
// GREEN<br/>
// YELLOW<br/>
// BLACK<br/>

$enumeratorObject2 = new Enumerator();

$enumeratorObject2->set('FF0000', 'RED');
$enumeratorObject2->set('0000FF', 'BLUE');
$enumeratorObject2->set('00FF00', 'GREEN');
$enumeratorObject2->set('FFFF00', 'YELLOW');
$enumeratorObject2->set('000000', 'BLACK');

echo 'HEX color code of RED is #' . $enumeratorObject2->RED . '<br/>'; // HEX color code of RED is #FF0000

foreach ($enumeratorObject2 as $key => $value) {
    echo $value . '<br/>';
}
// RED<br/>
// BLUE<br/>
// GREEN<br/>
// YELLOW<br/>
// BLACK<br/>

$enumeratorObject3 = new Enumerator();

$enumeratorObject3->RED = 'FF0000';
$enumeratorObject3->BLUE = '0000FF';
$enumeratorObject3->GREEN = '00FF00';
$enumeratorObject3->YELLOW = 'FFFF00';
$enumeratorObject3->BLACK = '000000';


echo 'HEX color code of RED is #' . $enumeratorObject3->RED . '<br/>'; // HEX color code of RED is #FF0000

foreach ($enumeratorObject3 as $key => $value) {
    echo $value . '<br/>';
}
// FF0000<br/>
// 0000FF<br/>
// 00FF00<br/>
// FFFF00<br/>
// 000000<br/>

$enumeratorObjectParent = new Enumerator();

$enumeratorObjectParent->COLOR = $enumeratorObject3;
$enumeratorObjectParent->FOO = 'bar';

echo 'HEX color code of RED is #' . $enumeratorObjectParent->COLOR->RED . '<br/>'; // HEX color code of RED is #FF0000

foreach ($enumeratorObjectParent as $key => $value) {
    if ($value instanceof Enumerator) {
        echo $key . '<br/>';
        foreach ($value as $value2) {
            echo ' - ' . $value2 . '<br/>';
        }
    } else {
        echo (string)$value . '<br/>';
    }
}
