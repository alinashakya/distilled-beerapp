<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */


class Welcome_test extends CIPHPUnitTestCase
{
	    public function setUp()
    {
        $this->obj = $this->newModel('Beermodel');
    }
	public function test_index()
	{
		$bdb    = new Brewerydb('149cfbf57afb9ac1288fab04fa188799');
        $params = array(
            'withBreweries' => 'Y'
        );
        $url    = "/brewery/4UcPMq/beers";
		$expected = $this->obj->getBreweryBeers($params, $url, $bdb);
		$output = $this->request('GET',['Beer','getRandomBeer']);
		print_r($expected);
	// $this->assertContains('name',$output);
		$this->assertContains(json_decode($expected),json_decode($output));
	}

	/**
	 * Use to test beers of a brewery
	 */
	public function test_getBreweryBeers()
	{
		// $output = $this->request('GET',['Beer','getBreweryBeers','4UcPMq']);
		// $this->assertContains('name',$output);
		// $this->assertContains('status',$output);	
	}

	/**
	 * Use to test beer or brewery search results
	 */
	public function test_searchBeerBrewery()
	{
		// $output = $this->request('POST',['Beer','searchBeerBrewery']);
		// $this->assertContains('Goosinator',$output);
		// $this->assertContains('status',$output);	
	}

	

	
}
