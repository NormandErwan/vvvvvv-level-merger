<?php

class Tabs
{
    private static $tabwidth = 40;
    private static $tabheight = 30;
    private $mapwidth;
    private $mapheight;
    private $tabsRaw;
    private $tabs;

    public function __construct() {
        $this->tabsRaw = null;
        $this->mapwidth = 5;
        $this->mapheight = 5;

        $this->tabs = array();

        for($i=1; $i<=5; ++$i)
            for($j=1; $j<=5; ++$j)
                $this->tabs[$i][$j] = array();
    }

    public function importXML($string) {
        $xml = simplexml_load_string($string);

        $this->tabsRaw = $xml->Data->contents->__toString();

        $tabs = explode(',', $this->tabsRaw);

        $line = array();

        for($i=0; $i<count($tabs)-1; ++$i){
            $tab_x = $this->getTabX($i);
            $tab_y = $this->getTabY($i);

            $line[] = (int) $tabs[$i];

            if(count($line) == 40){
                $this->tabs[$tab_x][$tab_y][] = $line;
                $line = array();
            }
        }
    }

    private function getTabX($index){
        return 1+(int) (floor($index / self::$tabwidth) % 5);
    }

    private function getTabY($index){
        return 1+(int) floor($index / (self::$tabwidth * $this->mapwidth * self::$tabheight));
    }

    public function whereIsMyLevelLocated(){
        $x = 0;
        $y = 0;
        $exit = false;

        for($i=1; $i<=5; ++$i) {
            for ($j = 1; $j <= 5; ++$j) {
                foreach($this->tabs[$i][$j] as $line) {
                    foreach($line as $block){
                        if($block != 0){
                            $x = $i;
                            $y = $j;
                            $exit = true;
                        }
                        if($exit)
                            break;
                    }
                    if($exit)
                        break;
                }
                if($exit)
                    break;
            }
            if($exit)
                break;
        }

        return array(
            'x' => $x,
            'y' => $y
        );
    }

    public function fillWithZeros($x, $y){
        for($j=0; $j<self::$tabheight; ++$j){
            $line = array();
            for($i=0; $i<self::$tabwidth; ++$i){
                $line[] = 0;
            }
            $this->tabs[$x][$y][] = $line;
        }
    }

    public function fillBlank(){
        for($i=1; $i<=5; ++$i)
            for($j=1; $j<=5; ++$j)
                $this->fillWithZeros($i, $j);
    }

    public function toString(){
        $txt = '';

        for($j=1; $j<=5; ++$j){
            for($l=0; $l<=29; ++$l){
                for($i=1; $i<=5; ++$i){
                    foreach($this->tabs[$i][$j][$l] as $b => $block){
                        $txt.= $block.',';
                    }
                }
            }
        }

        return $txt;
    }

    public function setTab($tab, $x, $y){
        $this->tabs[$x][$y] = $tab;
    }

    public function getTab(){
        $where = $this->whereIsMyLevelLocated();
        return $this->tabs[$where['x']][$where['y']];
    }
}