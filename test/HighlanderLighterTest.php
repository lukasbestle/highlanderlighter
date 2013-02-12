<?php

require_once('highlanderlighter.php');

class HighlanderLighterTest extends PHPUnit_Framework_TestCase {
	private $hl;
	private $hlc;
	
	private $testString = '#f{bold;red}This is a #{normal}normal text #b{green} #e{bell}with a system bell#{normal} and normal again.';
	private $testStringC = '!f{bold;red}This is a !{normal}normal text !b{green} !e{bell}with a system bell!{normal} and normal again.';
	
	private $result = "\033[1m\033[0;31mThis is a \033[0;39mnormal text \033[42m \033[mwith a system bell\033[0;39m and normal again.\033[0m";
	
	public function __construct() {
		$this->hl = new HighlanderLighter();
		$this->hlc = new HighlanderLighter("!");
	}
	
	public function testShouldRenderCorrectly() {
		$this->assertEquals($this->result, $this->hl->render($this->testString));
		$this->assertEquals($this->result, $this->hlc->render($this->testStringC));
	}
	
	public function testShouldEcho() {
		$this->expectOutputString($this->result);
		$this->hl->put($this->testString);
	}
}