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

$sum1 = 0;

// part2
foreach ($col1 as $value) {
	$sum1 += $value * count(array_filter($col2, fn($value2) => $value === $value2));
}
var_dump('sum2: '.$sum1);

// part1
sort($col1);
sort($col2);
$sum2 = 0;
foreach ($col1 as $key => $value) {
	$sum2 += abs($value - $col2[$key]);
}

var_dump('sum1: '.$sum2);

