<?php

	include 'model/Data.class.php';
	

echo 'tamere';

echo '<pre>';

for ($td = 1; $td <= 2; $td++) { 
	foreach (Data::loadXML($td) as $level){
		echo $level['name'] . $level['x'] . $level['y'];
	}
}

echo '</pre>';