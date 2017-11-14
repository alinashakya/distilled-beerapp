<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Connects to redis and caches data
 *
 * @param $key key name
 * @param $params param values to pass in api
 * @param $url api url
 * @return $values array
 */
function breweryDb_method($key,$params,$url)
{
    $redis = new Redis();
    $redis->connect(REDIS_CONNECT_SERVER,REDIS_CONNECT_PORT);
    if(!($redis->get($key))){
        $bdb = new Brewerydb(BREWERYDB_API_KEY);
        if($bdb){
            $results = $bdb->request($url, $params, 'GET');
            $redis->set($key, json_encode($results));
            $values = json_decode(json_encode($results));   
        }else{
            $data['results'][] = array(
                'status' => 'fail',
                'message' => 'Cannot connect to API.'
                );
        }
    }else{
        $values =  json_decode($redis->get($key));
    }
    return $values;
}
