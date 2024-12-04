<?php

$file = fopen('input', 'r');

$sum = 0;
while (!feof($file)) {
    $line = fgets($file);
    preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $line, $matches);
    // var_dump($matches);
    foreach ($matches[0] as $mul) {
        preg_match('/(\d{1,3}),(\d{1,3})/', $mul, $numbers);
        // var_dump($numbers);
        $sum += $numbers[1] * $numbers[2];
    }
}

var_dump($sum);
