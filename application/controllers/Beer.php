<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/Brewerydb.php');

class Beer extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
    }   

    /**
     * Default page that loads random beer details
     * Displays search section
     */
    public function index()
    { 
        $this->load->view('beer/beer');
    }

    /*
     * Get all beers in a brewery
     */
    public function getBreweryBeers($breweryId)
    {
        $breweryId = "$breweryId";
        $params = array(
            'withBreweries'=>'Y'
            );
        $url = "/brewery/$breweryId/beers";
        $values = breweryDb_method($breweryId,$params,$url);
        $array = $values->data;
        foreach($array as $avalues){
            $data['results'][] = array(
                'name' => $avalues->name,
                'description' => (isset($avalues->description))?$avalues->description:'',
                'image' => (isset($avalues->labels))?($avalues->labels->medium):$this->config->base_url('/images/placeholder.svg'),
                'status' => 'success'
                );
        }
        echo json_encode($data);
    }

    /*
     * Function used to get random beer details
    */
    public function getRandomBeer()
    {
        $params = array(
            'availableId'=>'1',
            'withBreweries'=>'Y',
            'hasLabels'=>'Y'
            );
        $url = "beers";
        $values = breweryDb_method('key',$params,$url);
        $array = $values->data;
        $arrayValues = array_rand($values->data);
        $v = $array[$arrayValues];
        if(!is_null($v->name) && isset($v->description)){
            echo json_encode(array(
                'name'=>$v->name,
                'description'=>isset($v->description)?$v->description:'',
                'image'=>((isset($v->labels))?($v->labels->medium):''),
                'breweryId'=> ((isset($v->breweries[0]))?($v->breweries[0]->id):'')
                ));
        } else {
            $this->getRandomBeer();     
        }
    }

    /*
     * Function used to search beer/brewery 
     */
    public function searchBeerBrewery()
    {
        $text = isset($_REQUEST['name'])?$_REQUEST['name']:'Goosinator';
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'beer';
        $params = array(
            'q'=>$text,
            'type'=>$type
            );
        $url = "/search";
        $values = breweryDb_method($text.$type,$params,$url);
        if(isset($values->data)){
            foreach($values->data as $val){
                $data['results'][] = array(
                    'status' => 'success',
                    'name' => isset($val->name)?($val->name):'',
                    'description' => isset($val->description)?($val->description):(($val->style)?($val->style->description):''),
                    'image' => isset($val->labels)?($val->labels->medium):$this->config->base_url('/images/placeholder.svg')
                    );
            }
        }else{
            $data['results'][] = array(
                'status' => 'fail',
                'message' => 'No results found.'
                );
        }
        echo json_encode($data);
    }   
}