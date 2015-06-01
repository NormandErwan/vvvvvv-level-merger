<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model/Data.class.php';
require_once 'model/Tabs.class.php';

$td = $_GET['td'];

$levels = Data::loadXML($td);


$final = new Tabs();
$final->fillBlank();


foreach($levels as $level){
    $myContent = new Tabs();
    $myContent->importXML($level['content']);
    $final->setTab($myContent->getTab(), $level['x'], $level['y']);
}

echo $final->toString();
