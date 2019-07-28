<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'test');

$t0 = microtime(true);
var_dump($t0);
$stmt = $mysqli->prepare("SELECT `v` FROM `kv` WHERE `k` = ?;");
$stmt->bind_param('s', $i);
$stmt->bind_result($v);
for ($i = 0; $i < 200000; $i++) {
    $stmt->execute();
    $stmt->fetch();
    if (($i & 1023) === 1) {
        echo $i, PHP_EOL;
    }
}
$stmt->close();
$t1 = microtime(true);
var_dump($t1);
var_dump($t1 - $t0);
