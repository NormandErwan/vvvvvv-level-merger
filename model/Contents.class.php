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
		
		$this->contents = array();

        for($i=1; $i<=5; ++$i)
            for($j=1; $j<=5; ++$j)
                $this->contents[$i][$j] = array();
	}
	
	public function importXML($string) {
		$xml = simplexml_load_string($string);
		$this->contentsRaw = $xml->Data->contents->__toString();
        echo 'RAW<br/>';
        var_dump($this->contentsRaw);
        echo '<br/>/GENERATE<br/>';
		$contents = explode(',', $this->contentsRaw);

        $line = array();
        $prev_y = 1;

        for($i=0; $i<count($contents); ++$i){
            $tab_x = $this->getTabX($i);
            $tab_y = $this->getTabY($i);
            $line[] = $contents[$i];

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
	
	public function setContents($contents) {
		$this->contents = $contents;
	}
	
	public function getContents() {
		return $this->contents;
	}
	
	public function getTab($x, $y) {

	}
}