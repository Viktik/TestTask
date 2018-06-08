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
convert(50, "Gbp");
