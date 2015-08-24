<?php
use Naucon\Utility\ArrayPath;
$array = array();
$array['setting']['database']['name'] = 'tipp';
$array['setting']['database']['user'] = 'user';
$array['setting']['database']['pass'] = 'pw';
$array['setting']['template']['file'] = 'framework.html';

$arrayPathObject = new ArrayPath($array);
$arrayPathObject->set('setting.template.title', 'Titel');
$arrayPathObject->set('setting.database.pass', 'Kennwort');
var_dump($arrayPathObject->get());
var_dump($arrayPathObject->get('setting.database'));