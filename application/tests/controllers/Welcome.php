<?php 

require_once(APPPATH.'libraries/Brewerydb.php')

class Welcome extends TestCase{
	public function test_get_hello(){
	$output = $this->request('GET',['Hello','get_hello']);
	$expected = '<h2>Hello!</h2>';
	$this->assertContains($expected,$output);
	}
}