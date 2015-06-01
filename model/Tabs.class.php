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

    }

    public function importXML($string) {
        $xml = simplexml_load_string($string);
        $this->tabsRaw = $xml->Data->tabs->__toString();

        $this->contents = $this->extractContent($this->tabsRaw);
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

    public function whereIsMyLevelLocated(){

        for($i=1; $i<=5; ++$i) {
            for ($j = 1; $j <= 5; ++$j) {
                foreach($this->contents[$i][$j] as $line) {
                    foreach($line as $block){
                        if($block != '0'){
                            return array(
                                'x' => $i,
                                'y' => $j
                            );
                        }
                    }
                }
            }
        }

        return array();
    }

    public function fillWithZeros($x, $y){
        for($j=0; $j<self::$tabheight; +$j){
            $line = array();
            for($i=0; $i<self::$tabwidth; ++$i){
                $line[] = '0';
            }
            $this->contents[$x][$y][] = $line;
        }
    }

    public function extractContent($txt){
        $tabs = explode(',', $txt);
        $output = array();

        for($i=1; $i<=5; ++$i)
            for($j=1; $j<=5; ++$j)
                $output[$i][$j] = array();

        $line = array();
        $prev_y = 1;

        for($i=0; $i<count($tabs); ++$i){
            $tab_x = $this->getTabX($i);
            $tab_y = $this->getTabY($i);
            $line[] = $tabs[$i];

            if($prev_y != $tab_y){
                $output[$tab_x][$tab_y][] = $line;
                $line = array();
            }
        }

        return $output;
    }

    public function pushOnlyNonZeros($tab){
        $txt = '';

        for($i=1; $i<=5; ++$i){
            for($j=1; $j<=5; ++$i) {
                foreach($this->contents[$i][$j] as $l => $line) {
                    foreach($line as $b => $block){
                        if($block != '0'){
                            $txt.= $block.',';
                        }else{
                            $txt.= $tab[$i][$j][$l][$b];
                        }
                    }
                }
            }
        }

        return $txt;
    }

    public function merge($txt, $x, $y){
        $where = $this->whereIsMyLevelLocated();
        $this->contents[$x][$y] = $this->contents[$where['x']][$where['y']];

        if($where['x'] != $x || $where['y'] != $y)
            $this->fillWithZeros($where['x'], $where['y']);

        $tab = $this->extractContent($txt);

        return $this->pushOnlyNonZeros($tab);
    }
}