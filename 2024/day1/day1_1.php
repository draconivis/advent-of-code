<?php

$file = fopen('input', 'r');

$col1 = [];
$col2 = [];
while (!feof($file)) {
    $line = fgets($file);
    preg_match('/(\d+)   (\d+)/', $line, $matches);
    // var_dump($matches);
    $col1[] = $matches[1];
    $col2[] = $matches[2];
}

sort($col1);
sort($col2);
$sum = 0;
foreach ($col1 as $key => $value) {
    $sum += abs($value - $col2[$key]);
}

var_dump($sum);
