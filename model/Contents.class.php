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