<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model/Data.class.php';
require_once 'model/Tabs.class.php';

$name = $_POST['name'];
$data = $_POST['data'];
$x = $_POST['x'];
$y = $_POST['y'];
$td = $_POST['td'];

$success = Data::saveXML($data, $name, $x, $y, $td);

if ($success) {
	header('Location: index.html');   
}