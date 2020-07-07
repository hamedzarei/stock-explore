<?php
/**
 * Created by PhpStorm.
 * User: zrhm7232
 * Date: 7/7/20
 * Time: 9:28 PM
 */


include_once 'vendor/autoload.php';
include_once 'GetAllStocks.php';

function getHistory($isin, $days = 30)
{
    $client = new \GuzzleHttp\Client(['verify' => false ]);
    $history = [];
    $history = $client->get("https://rlcwebapi.tadbirrlc.com/ChartData/priceHistory?symbol=$isin&resolution=D&beforeDays=$days&outType=splineArea");
    $history = (string)$history->getBody();
    $history = json_decode($history, true);

    return $history;
}

$stocks = getStocks();
//$stocks = array_slice($stocks, 0, 10);
foreach ($stocks as $index => $stock) {
    $isin = $stock['isin'];
    $history = getHistory($isin);
//    var_dump($history[count($history)-1]['prices'][0]);
//    var_dump($history[0]['prices'][0]);
    if (!$history) {
//        unset($stocks[$index]);
        continue;
    }
    if ($history[0]['prices'][0] == 0) {
//        unset($stocks[$index]);
        continue;
    }
    $stocks[$index]['percent'] = ($history[count($history)-1]['prices'][0] - $history[0]['prices'][0]) / $history[0]['prices'][0];
//    var_dump($stocks[$index]);
//    die();
}

usort($stocks, function ($a, $b) {
//    if (!array_key_exists('percent', $a) && !array_key_exists('percent', $b))
    return $a['percent'] < $b['percent'];
});

var_dump($stocks);