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

$j = 0; // backward
while (true) {
    if ($j >= $len) {
        break;
    }
    if ('.' === $fragmentedMap[$len - $j]) {
        $j++;
        continue;
    }

    $fileLen = 1;
    while ($fragmentedMap[$len - $j - $fileLen] === $fragmentedMap[$len - $j]) {
        if ($j + $fileLen >= $len) {
            break(2);
        }
        $fileLen++;
    }

    $i = 0;
    $freeBlockLen = 1;
    while (true) {
        if ($i >= $len - $j) {
            $j += $fileLen; // skip to beginning of file block
            break;
        } elseif ('.' !== $fragmentedMap[$i]) {
            $i++;
            continue;
        }
        while ($fragmentedMap[$i + $freeBlockLen] === '.') {
            $freeBlockLen++;
        }
        if ($freeBlockLen < $fileLen) {
            $i += $freeBlockLen; // skip to end of free block and check further
            $freeBlockLen = 1; // reset free block len
            continue;
        }
        foreach (range(0, $fileLen - 1) as $k) {
            $fragmentedMap[$i + $k] = $fragmentedMap[$len - $j - $k];
            $fragmentedMap[$len - $j - $k] = '.';
        }
        $j += $fileLen; // skip to beginning of file block
        break;
    }
}

$sum = 0;
foreach ($fragmentedMap as $i => $char) {
    if ('.' === $char) {
        continue;
    }
    $sum += $i * $char;
}

var_dump($sum);
