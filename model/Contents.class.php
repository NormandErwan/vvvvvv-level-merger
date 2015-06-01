<?php

class Contents
{
	private static $tabwidth = 40;
	private static $tabheight = 31;
	private $mapwidth;
	private $mapheight;
	private $contentsRaw;
	private $contents;
	
	public function __construct() {
		$this->contentsRaw = null;
		$this->mapwidth = 5;
		$this->mapheight = 5;
		
		$this->contents = array(
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array())); // coucou :)
	}
	
	public function importXML($string) {
		$xml = simplexml_load_string($string);
		$this->contentsRaw = $xml->Data->contents->__toString();
		
		$contents = explode(',', $this->contentsRaw);

        $line = array();
        $prev_y = 1;

        for($i=0; $i<count($contents); ++$i){
            $tab_x = (int) floor($i / self::$tabwidth);
            $tab_y = (int) floor($i / (self::$tabwidth * self::$tabheight * $this->mapwidth));
            $line[] = $contents[$i];

            if($prev_y != $tab_y){
                $this->contents[$tab_x][$tab_y] = $line;
                $line = array();
            }
        }
	}
	
	public function setContents($contents) {
		$this->contents = $contents;
	}
	
	public function getContents() {
		return $this->contents;
	}
	
	public function getTab($x, $y) {

	}
}