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

		$this->contents = array();

        for($i=1; $i<=5; ++$i)
            for($j=1; $j<=5; ++$j)
                $this->contents[$i][$j] = array();

	}
	
	public function importXML($string) {
		$xml = simplexml_load_string($string);
		$this->tabsRaw = $xml->Data->tabs->__toString();
		
		$tabs = explode(',', $this->tabsRaw);

        $line = array();
        $prev_y = 1;

        for($i=0; $i<count($tabs); ++$i){
            $tab_x = $this->getTabX($i);
            $tab_y = $this->getTabY($i);
            $line[] = $tabs[$i];

            if($prev_y != $tab_y){
                /*echo '<br/>LINE '.count($this->contents[$tab_x][$tab_y]).'<br/>';
                var_dump($line);
                echo '<br/>';*/
                $this->contents[$tab_x][$tab_y][] = $line;
                $line = array();
            }
        }
	}

    private function getTabX($index){
        return (int) floor($index / self::$tabwidth) % 5 +1;
    }

    private function getTabY($index){
        return (int) floor($index / (self::$tabwidth * $this->mapwidth * self::$tabheight)) +1;
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