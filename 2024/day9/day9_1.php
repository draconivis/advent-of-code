<?php

$file = fopen('input', 'r');
$line = fgets($file);
$input = array_map('intval', str_split(trim($line)));
// $input = [2,3,3,3,1,3,3,1,2,1,4,1,4,1,3,1,4,0,2];

$fragmentedMap = [];
foreach ($input as $i => $char) {
    for ($j = 0; $j < $char; $j++) {
        $fragmentedMap[] = 0 === $i % 2 ? $i / 2 : '.';
    }
}


$len = count($fragmentedMap) - 1;

for ($i = 0; $i < count($fragmentedMap); $i++) {
    if ('.' !== $fragmentedMap[$i]) {
        continue;
    }

    $j = 0;
    while (true) {
        if ($len - $j <= $i) {
            break(2);
        } elseif ('.' === $fragmentedMap[$len - $j]) {
            $j++;
            continue;
        }
        $fragmentedMap[$i] = $fragmentedMap[$len - $j];
        $fragmentedMap[$len - $j] = '.';
        break;
    }
}

$sum = 0;
foreach ($fragmentedMap as $i => $char) {
    if ('.' === $char) {
        break;
    }
    $sum += $i * $char;
}

var_dump($sum);
