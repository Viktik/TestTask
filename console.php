<?php
include 'Converter (2).php';

if (empty($argv[1]) or empty($argv[2])){
    echo "Empty statement given";
    }

$converter = new Converter();
try{
    $result = $converter->convert($argv[1], $argv[2]);
}catch(Exception $e) {
    echo $e->getMessage();
}

echo "result:" . $result;