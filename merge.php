<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model/Data.class.php';
require_once 'model/Tabs.class.php';

$td = $_POST['td'];

$levels = Data::loadXML($td);

// Create the merged level
$finalTabs = new Tabs();
$finalTabs->fillBlank();

$final = new Tabs();
$final->fillBlank();

foreach($levels as $level){
    $myContent = new Tabs();
    $myContent->importXML($level['data']);
    $final->setTab($myContent->getTab(), $level['x'], $level['y']);
    unset($myContent);

}

// Create the XML file
$finalFile = simplexml_load_file('data/level_layout.vvvvvv');
$finalFile->Data->contents = $finalTabs->toString();

// Download the XML file
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename=VVVVVV_level_merged.vvvvvvv');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
print($finalFile->asXML());
