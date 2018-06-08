<?php
//https://api.coindesk.com/v1/bpi/currentprice/BTC.json
function converter (int $usd, string $curr){
    $json = file_get_contents('http://www.floatrates.com/daily/usd.json');
    $obj = json_decode($json, true);

    $curr = trim(strtolower($curr));
    $rate = $obj["$curr"]["rate"];
    $price = $usd * $rate;
    echo "Стоимость в ". $curr . " = " . $price;
}

converter(100, "eur");