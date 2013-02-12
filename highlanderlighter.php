<?php

/**
 * highlanderlighter.php
 * A PHP command line text highlighter made for CLIs.
 *
 * @version 1.0
 * @author Lukas Bestle <lukas@lu-x.me>
 * @link http://lu-x.me/
 * @copyright Copyright 2013 Lukas Bestle
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package HighlanderLighter
 */

class HighlanderLighter {
	private $available = array(
		"f" => array(
			"bold"         => "1",
			"dim"          => "2",
			"underline"    => "4",
			"black"        => "0;30",
			"dark_gray"    => "1;30",
			"blue"         => "0;34",
			"light_blue"   => "1;34",
			"green"        => "0;32",
			"light_green"  => "1;32",
			"cyan"         => "0;36",
			"light_cyan"   => "1;36",
			"red"          => "0;31",
			"light_red"    => "1;31",
			"purple"       => "0;35",
			"light_purple" => "1;35",
			"brown"        => "0;33",
			"yellow"       => "1;33",
			"light_gray"   => "0;37",
			"white"        => "1;37"
		),
		"b" => array(
			"black"        => "40",
			"red"          => "41",
			"green"        => "42",
			"yellow"       => "43",
			"blue"         => "44",
			"magenta"      => "45",
			"cyan"         => "46",
			"light_gray"   => "47"
		),
		"e" => array(
			"blink"     => "5",
			"reverse"   => "7",
			"hidden"    => "8",
			"bell"      => "\007"
		),
		"default" => array(
			"normal" => "0;39"
		)
	);
	
	private $commandChar = "#";
	
	public function __construct($commandChar="#") {
		$this->commandChar = $commandChar;
	}
	
	public function put($text) {
		echo $this->parser($text);
	}
	
	public function render($text) {
		return $this->parser($text);
	}
	
	private function parser($text) {
		// The method $this->match()
		$method = array($this, 'match');
		
		// Match the portions of options (all the magic!) using $this->match()
		$matched = preg_replace_callback('/' . $this->commandChar . '(.?){(.*?)}/', $method, $text);
		
		// Normalize again
		return $matched . "\033[0m";
	}
	
	private function match($hit) {
		$typeName = $hit[1];
		$options = explode(";", $hit[2]);
		
		// Get the correct category
		if(isset($this->available[$typeName])) {
			$type = $this->available[$typeName];
		} else {
			$type = $this->available["default"];
		}
		
		$return = "";
		foreach($options as $option) {
			// No valid option?
			if(!isset($type[$option])) continue;
			
			if(substr($type[$option], 0, 1) == "\\") {
				// Already a symbol, no need to put it into the syntax for highlighting (used for the beep, for example)
				$return .= $type[$option];
			} else {
				$return .= "\033[" . $type[$option] . "m";
			}
		}
		return $return;
	}
}