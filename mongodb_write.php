<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client();
$collection = $client->test->kv;
$collection->createIndex(['k' => 1], ['unique' => true]);

$v = random_bytes(1000);

$t0 = microtime(true);
var_dump($t0);
for ($i = 0; $i < 200000; $i++) {
    $collection->insertOne(['k' => $i, 'v' => new \MongoDB\BSON\Binary($v, \MongoDB\BSON\Binary::TYPE_GENERIC)]);
    if (($i & 1023) === 1) {
        echo $i, PHP_EOL;
    }
}
$t1 = microtime(true);
var_dump($t1);
var_dump($t1 - $t0);
