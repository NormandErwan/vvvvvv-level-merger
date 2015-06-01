<?php

class Content
{	
	private $content;
	
	public function __construct() {
		$this->content = null;
	}
	
	public function setXML($xml) {
		
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function getTab($x, $y) {
		
	}
}