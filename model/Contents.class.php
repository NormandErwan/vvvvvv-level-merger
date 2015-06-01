<?php

class Contents
{
	private $mapwidth;
	private $mapheight;
	private $contents;
	
	public function __construct() {
		$this->contents = null;
		$this->mapwidth = 5;
		$this->mapheight = 5;
	}
	
	public function importXML($string) {
		$xml = simplexml_load_string($string);
		$this->content = $xml->Data->contents->__toString();
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