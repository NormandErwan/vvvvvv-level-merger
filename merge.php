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

foreach($levels as $level){
    $myContent = new Tabs();
    $myContent->importXML($level['data']);
    $finalTabs->setTab($myContent->getTab(), $level['x'], $level['y']);
}

// Create the XML file
$finalFile = simplexml_load_file('data/level_layout.vvvvvv');
$finalFile->Data->contents = $finalTabs->toString();

$dom_sxe = dom_import_simplexml($finalFile);
if (!$dom_sxe) {
    echo 'Erreur lors de la conversion du XML';
    exit;
}

$dom = new DOMDocument('1.0');
$dom_sxe = $dom->importNode($dom_sxe, true);
$dom_sxe = $dom->appendChild($dom_sxe);

// Download the XML file
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename=VVVVVV_level_merged.vvvvvv');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
print($dom->saveXML(null, LIBXML_NOEMPTYTAG));
