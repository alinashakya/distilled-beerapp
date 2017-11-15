 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beer extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->config->set_item('apiKey', '149cfbf57afb9ac1288fab04fa188799');
        $this->load->library('Brewerydb');
    }
    
    /*
     * Get all beers in a brewery
     * @param $breweryId Brewery ID
     */
    public function getBreweryBeers($breweryId)
    {
        $data   = array();
        $bdb    = new Brewerydb($this->config->item('apiKey'));
        $params = array(
            'withBreweries' => 'Y'
        );
        $url    = "/brewery/$breweryId/beers";
        try {
            $values = breweryDb_method("$breweryId", $params, $url, $bdb);
            foreach ($values->data as $avalues) {
                $data['results'][] = array(
                    'name' => isset($avalues->name) ? $avalues->name : '',
                    'description' => (isset($avalues->description)) ? $avalues->description : '',
                    'image' => (isset($avalues->labels)) ? ($avalues->labels->medium) : $this->config->base_url('/images/placeholder.svg'),
                    'status' => 'success'
                );
            }
            echo json_encode($data);
        }
        catch (Exception $e) {
            throw new Exception("Error Processing Request, $e->getMessage()", 1);
        }
        
    }
    
    /*
     * Function used to get random beer details
     */
    public function getRandomBeer()
    {
        $bdb    = new Brewerydb($this->config->item('apiKey'));
        $params = array(
            'availableId' => '1',
            'withBreweries' => 'Y',
            'hasLabels' => 'Y'
        );
        try {
            $values      = breweryDb_method('key', $params, "beers", $bdb);
            $array       = $values->data;
            $arrayValues = array_rand($values->data);
            $v           = $array[$arrayValues];
            if (!is_null($v->name) && isset($v->description)) {
                echo json_encode(array(
                    'name' => $v->name,
                    'description' => isset($v->description) ? $v->description : '',
                    'image' => ((isset($v->labels)) ? ($v->labels->medium) : ''),
                    'breweryId' => ((isset($v->breweries[0])) ? ($v->breweries[0]->id) : '')
                ));
            } else {
                $this->getRandomBeer();
            }
        }
        catch (Exception $e) {
            throw new Exception("Error Processing Request, $e->getMessage()", 1);
        }
    }
    
    /*
     * Function used to search beer/brewery 
     */
    public function searchBeerBrewery()
    {
        $bdb    = new Brewerydb($this->config->item('apiKey'));
        $text   = isset($_REQUEST['name']) ? $_REQUEST['name'] : 'Goosinator';
        $type   = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'beer';
        $params = array(
            'q' => $text,
            'type' => $type
        );
        try {
            $values = breweryDb_method($text . $type, $params, "/search", $bdb);
            if (isset($values->data)) {
                foreach ($values->data as $val) {
                    $data['results'][] = array(
                        'status' => 'success',
                        'name' => isset($val->name) ? ($val->name) : '',
                        'description' => isset($val->description) ? ($val->description) : (($val->style) ? ($val->style->description) : ''),
                        'image' => isset($val->labels) ? ($val->labels->medium) : $this->config->base_url('/images/placeholder.svg')
                    );
                }
            } else {
                $data['results'][] = array(
                    'status' => 'fail',
                    'message' => 'No results found.'
                );
            }
            echo json_encode($data);
        }
        catch (Exception $e) {
            throw new Exception("Error Processing Request, $e->getMessage()", 1);
        }
    }
} 