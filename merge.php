<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Data.class.php';
require_once 'model/Contents.class.php';

$name = $_POST['name'];
$data = $_POST['data'];
$x = $_POST['x'];
$y = $_POST['y'];
$td = $_POST['td'];

var_dump($name);
var_dump($data);
var_dump($x);
var_dump($y);
var_dump($td);

Data::saveXML($data, $name, $x, $y, $td);
echo '<br/>';

$levels = Data::loadXML($td);
$contents[] = array();
var_dump($levels);

foreach($levels as $level){
    $myContent = new Contents();
    $myContent->importXML($level['content']);
    $contents[] = $myContent;
}

echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
var_dump($levels);

//Merge $levels