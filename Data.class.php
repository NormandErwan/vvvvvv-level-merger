<?php

class Data {

    public static function saveXML($data, $name, $x, $y, $TD = 1){
        if(file_put_contents('data/td'.$TD.'/'.$x.'_'.$y.'-'.$name.'.vvvvvv', $data)){
            echo 'Okay man !';
        }
    }

    public static function loadXML($TD){
        $output = array();
        $dir = 'data/td'.$TD.'/';

        if ($handle = opendir($dir)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {
                    
                    $output[] = file_get_contents($dir.$entry);
                }
            }

            closedir($handle);
        }

        return $output;
    }
}
