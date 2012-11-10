<?php
class HighlanderLighter {
	private $available = array(
		"f" => array(
			"bold"         => "1",
			"dim"          => "2",
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
			"underline" => "4",
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
	
	public function put($text) {
		echo preg_replace_callback('/#(.?){(.*?)}/', array($this, 'match'), $text) . "\033[0m";
	}
	
	private function match($hit) {
		if(isset($this->available[$hit[1]])) {
			$use = $this->available[$hit[1]];
		} else {
			$use = $this->available["default"];
		}
		
		$return = "";
		foreach(explode(";", $hit[2]) as $option) {
			if(!isset($use[$option])) continue;
			
			if(substr($use[$option], 0, 1) == "\\") {
				$return .= $use[$option];
			} else {
				$return .= "\033[" . $use[$option] . "m";
			}
		}
		return $return;
	}
}