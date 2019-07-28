<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client();
$collection = $client->test->kv;

$t0 = microtime(true);
var_dump($t0);
for ($i = 0; $i < 200000; $i++) {
    $result = $collection->findOne(['k' => $i]);
    if (($i & 1023) === 1) {
        echo $i, PHP_EOL;
    }
}
$t1 = microtime(true);
var_dump($t1);
var_dump($t1 - $t0);
