<?php

class Tabs
{
	private static $tabwidth = 40;
	private static $tabheight = 31;
	private $mapwidth;
	private $mapheight;
	private $tabsRaw;
	private $tabs;
	
	public function __construct() {
		$this->tabsRaw = null;
		$this->mapwidth = 5;
		$this->mapheight = 5;
		
		$this->tabs = array(
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array()),
			array(array(), array(), array(), array(), array())); // coucou :)
	}
	
	public function importXML($string) {
		$xml = simplexml_load_string($string);
		$this->tabsRaw = $xml->Data->tabs->__toString();
		
		$tabs = explode(',', $this->tabsRaw);

        $line = array();
        $prev_y = 1;

        for($i=0; $i<count($tabs); ++$i){
            $tab_x = (int) floor($i / self::$tabwidth);
            $tab_y = (int) floor($i / (self::$tabwidth * self::$tabheight * $this->mapwidth));
            $line[] = $tabs[$i];

            if($prev_y != $tab_y){
                $this->tabs[$tab_x][$tab_y] = $line;
                $line = array();
            }
        }
	}
	
	public function settabs($tabs) {
		$this->tabs = $tabs;
	}
	
	public function gettabs() {
		return $this->tabs;
	}
	
	public function getTab($x, $y) {

	}
}