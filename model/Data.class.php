<?php

class Data {
	
	public static function tdLocation($td) {
		return $dir = 'data/td'.$td.'/';
	}
	
	public static function fileLocation($name, $x, $y, $td) {
		return self::tdLocation($td) . $x.'_'.$y.'-'.$name.'.vvvvvv';
	}

    public static function saveXML($data, $name, $x, $y, $td = 1){
		$file = self::fileLocation($name, $x, $y, $td);
        if (!file_put_contents($file, $data)) {
            trigger_error('Cannot save the vvvvvv file : ' . $file, E_USER_ERROR);
        }
		return true;
    }

    public static function loadXML($td){
        $output = array();
		$dir = self::tdLocation($td);

        if ($handle = opendir($dir)) {
	
            while (false !== ($entry = readdir($handle))) {
				
                if ($entry != "." && $entry != "..") {
					
                    $x = substr($entry, 0, 1);
                    $y = substr($entry, 2, 1);
					$name = explode('.', explode('-', $entry)[1])[0];
					
                    $output[] = array(
						'name' => $name,
                        'x' => $x,
                        'y' => $y,
                        'data' => file_get_contents($dir.$entry)
                    );
                }
            }

            closedir($handle);
        }

        return $output;
    }
	
	public static function deleteXML($name, $x, $y, $td) {
		$file = self::fileLocation($name, $x, $y, $td);
		if (!unlink($file)) {
			trigger_error('Cannot delete the vvvvvv file : ' . $file, E_USER_ERROR);
		}
		return true;
	}
}
