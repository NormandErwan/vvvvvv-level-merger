<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model/Data.class.php';

$name = $_GET['name'];
$x = $_GET['x'];
$y = $_GET['y'];
$td = $_GET['td'];

$success = Data::deleteXML($name, $x, $y, $td);

if ($success) {
	header('Location: index.php');   
}