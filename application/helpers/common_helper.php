<?php


/*
 * Connects to redis and caches data
 *
 * @param $key key name
 * @param $params param values to pass in api
 * @param $url api url
 * @param $bdb
 * @return $values array
 */
function breweryDb_method($key, $params, $url, $bdb)
{
    $redis = new Redis();
    $redis->connect(REDIS_CONNECT_SERVER, REDIS_CONNECT_PORT);
    if (!($redis->get($key))) {
        $results = $bdb->request($url, $params, 'GET');
        $redis->set($key, json_encode($results));
        $values = json_decode(json_encode($results));
    } else {
        $values = json_decode($redis->get($key));
    }
    return $values;
}
