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

$sum = 0;
foreach ($col1 as $value) {
    $sum += $value * count(array_filter($col2, fn ($value2) => $value === $value2));
}
var_dump($sum);
