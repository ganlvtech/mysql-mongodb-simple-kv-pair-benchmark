<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'test');

$v = random_bytes(1000);
$t0 = microtime(true);
$mysqli->query("SET AUTOCOMMIT=0;");
var_dump($t0);
$stmt = $mysqli->prepare("INSERT INTO `kv` (`k`, `v`) VALUES (?, ?);");
$stmt->bind_param('ss', $i, $v);
for ($i = 0; $i < 200000; $i++) {
    $stmt->execute();
    if (($i & 1023) === 1) {
        echo $i, PHP_EOL;
    }
}
$stmt->close();
$t1 = microtime(true);
var_dump($t1);
var_dump($t1 - $t0);
