<?php

/**
 * Class Converter
 */
class Converter
{
    /**
     * @var string
     */
    public $defaultCurrency = 'USD';

    /**
     * @var array
     */
    public $allowedCurrencies = [
        'UAH',
        'EUR',
        'GBP'
    ];

    /**
     * @param int $price
     * @param string $currency
     * @return int
     * @throws Exception
     */
    public function convert(int $price, string $currency): float
    {
        $currency = trim(strtoupper($currency));
        if (!in_array($currency, $this->allowedCurrencies)) {
            throw new \Exception("Currency not suported");
        }

        $rate = $this->getRate($currency);

        return $price * $rate;
    }

    /**
     * @param string $currency
     * @return bool|string
     * @throws Exception
     */
    public function getRate(string $currency): float 
    {
        $ratePrefix = $this->defaultCurrency . "_" . $currency;
        $rate = file_get_contents("https://free.currencyconverterapi.com/api/v5/convert?q="
            . $ratePrefix . "&compact=y");
        if ($rate === false) {
            throw new \Exception("Error loading rate");
        }

        $rateArray = json_decode($rate, true);
        if (!isset($rateArray[$ratePrefix]) || !isset($rateArray[$ratePrefix]['val'])) {
            throw new \Exception("Error parsing rate");
        }

        $rate = $rateArray[$ratePrefix]['val'];
        return $rate;
    }
}
