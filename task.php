<?php

function convert(int $usd, string $value){
    $jsonEur= file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=USD_EUR&compact=y');
    $arrEur = json_decode($jsonEur,true);
    $eur = $arrEur['USD_EUR']['val'];
    $currencies['eur']= $eur;

    $jsonUah= file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=USD_UAH&compact=y');
    $arrUah = json_decode($jsonUah,true);
    $uah = $arrUah['USD_UAH']['val'];
    $currencies['uah']= $uah;

    $jsonGbp= file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=USD_GBP&compact=y');
    $arrGbp = json_decode($jsonGbp,true);
    $gbp = $arrGbp['USD_GBP']['val'];
    $currencies['gbp']= $gbp;

    $value = trim(strtoupper($value));
    switch ($value){
        case "EUR": echo "Price in EUR is " . $usd * $currencies['eur']; break;
        case "UAH": echo "Price in UAH is " . $usd * $currencies['uah']; break;
        case "GBP": echo "Price in GBP is " . $usd * $currencies['gbp']; break;
        default: echo "Wrong currency given";
    }
}
//convert(50, "Gbp");

function convertator(int $usd, string $currency){
    $currencyName = trim(strtoupper($currency));

    function getCurr(string $value){
        $json = file_get_contents("https://free.currencyconverterapi.com/api/v5/convert?q=USD_".$value."&compact=y");
        $arr = json_decode($json,true);
        $rate = $arr["USD_". $value]['val'];
        return $rate;
    }

    switch ($currencyName){
        case "UAH": $rate = getCurr("UAH");
            echo "Price in UAH = ". $rate * $usd;break;
        case "EUR": $rate = getCurr("EUR");
            echo "Price in EUR = ". $rate * $usd;break;
        case "GBP": $rate = getCurr("GBP");
            echo "Price in GBP = ". $rate * $usd;break;
        default: echo "Wrong currency given";
    }
}
convertator(50, "eur   ");