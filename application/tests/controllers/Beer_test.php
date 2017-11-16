<?php
/**
 * ci-phpunit-test to test brewery db api functions
 *
 * @author Alina Shakya<alina.shakya3@gmail.com>
 */


class Beer_test extends CIPHPUnitTestCase
{
    /**
     * Use to test random beer details
     */
    public function test_getRandomBeer()
    {
        try {
            $output = $this->request('GET',['Beer','getRandomBeer']);
        }
        catch (CIPHPUnitTestExitException $e) {
            $output = 'Failed to run';
        }
        $this->assertContains('name', $output);
        $this->assertContains('breweryId', $output);
        $this->assertNotEmpty($output);
        $this->assertResponseCode(200);
    }
    
    /**
     * Use to test beers of a brewery
     */
    public function test_getBreweryBeers()
    {
        try {
            $output = $this->request('GET',['Beer','getBreweryBeers','4UcPMq']);
        }
        catch (CIPHPUnitTestExitException $e) {
            $output = 'Failed to run'; 
        }
        $this->assertContains('name', $output);
        $this->assertContains('status', $output);
        $this->assertNotEmpty($output);
        $this->assertResponseCode(200);
    }
    
    /**
     * Use to test beer or brewery search results
     */
    public function test_searchBeerBrewery()
    {
        try {
            $output = $this->request('POST',['Beer','searchBeerBrewery']);
        }
        catch (CIPHPUnitTestExitException $e) {
            $output = 'Failed to run';
        }
        $this->assertContains('Goosinator', $output);
        $this->assertContains('status', $output);
        $this->assertNotEmpty($output);
        $this->assertResponseCode(200);
    }
}