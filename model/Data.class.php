<?php

class Data {
	
	public static function TD_location($TD) {
		return $dir = 'data/td'.$TD.'/';
	}

    public static function saveXML($data, $name, $x, $y, $TD = 1){
		$file = TD_location($TD) . $x.'_'.$y.'-'.$name.'.vvvvvv';
        if (!file_put_contents($file, $data)) {
            trigger_error('Cannot save the vvvvvv file : ' . $file, E_USER_ERROR);
        }
		return true;
    }

    public static function loadXML($TD){
        $output = array();
		$dir = self::TD_location($TD);

        if ($handle = opendir($dir)) {
	
            while (false !== ($entry = readdir($handle))) {
				
                if ($entry != "." && $entry != "..") {
					
                    $x = substr($entry, 0, 1);
                    $y = substr($entry, 2, 1);
					$name = explode('-', $entry)[1];
					
                    $output[] = array(
						'name' => $name,
                        'x' => $x,
                        'y' => $y,
                        'content' => file_get_contents($dir.$entry)
                    );
                }
            }

            closedir($handle);
        }

        return $output;
    }
}
