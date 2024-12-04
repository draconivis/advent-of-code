<?php

$file = fopen('input', 'r');

$sum = 0;
$shouldProcess = true; // had to move this outside the while, as the `don't` instructions should be carried on to the next input line
while (!feof($file)) {
    $line = fgets($file);
    preg_match_all('/mul\(\d{1,3},\d{1,3}\)|do\(\)|don\'t\(\)/', $line, $matches);
    // var_dump($matches);
    foreach ($matches[0] as $instruction) {
        if ('do()' === $instruction) {
            $shouldProcess = true;
        } elseif ('don\'t()' === $instruction) {
            $shouldProcess = false;
        } else {
            if ($shouldProcess) {
                preg_match('/(\d{1,3}),(\d{1,3})/', $instruction, $numbers);
                // var_dump($numbers);
                $sum += $numbers[1] * $numbers[2];
                var_dump($sum);
            }
        }
    }
}

var_dump($sum);
