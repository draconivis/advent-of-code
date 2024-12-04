<?php

$file = fopen('input', 'r');

// $input = [
//     ['M', 'M', 'M', 'S', 'X', 'X', 'M', 'A', 'S', 'M' ],
//     ['M', 'S', 'A', 'M', 'X', 'M', 'S', 'M', 'S', 'A' ],
//     ['A', 'M', 'X', 'S', 'X', 'M', 'A', 'A', 'M', 'M' ],
//     ['M', 'S', 'A', 'M', 'A', 'S', 'M', 'S', 'M', 'X' ],
//     ['X', 'M', 'A', 'S', 'A', 'M', 'X', 'A', 'M', 'M' ],
//     ['X', 'X', 'A', 'M', 'M', 'X', 'X', 'A', 'M', 'A' ],
//     ['S', 'M', 'S', 'M', 'S', 'A', 'S', 'X', 'S', 'S' ],
//     ['S', 'A', 'X', 'A', 'M', 'A', 'S', 'A', 'A', 'A' ],
//     ['M', 'A', 'M', 'M', 'M', 'X', 'M', 'M', 'M', 'M' ],
//     ['M', 'X', 'M', 'X', 'A', 'X', 'M', 'A', 'S', 'X' ],
// ];
$input = [];
while (!feof($file)) {
    $input[] = array_filter(str_split(fgets($file)), fn ($elem) => "\n" !== $elem);
}

$count = 0;

foreach ($input as $i => $line) {
    foreach ($line as $j => $char) {
        $current = false;
        $upLeft = false;
        $upRight = false;
        $downLeft = false;
        $downRight = false;

        //current
        if ('A' === $char) {
            $current = true;
        }
        $upLeftChar = $input[$i - 1][$j - 1] ?? null;
        $upRightChar = $input[$i - 1][$j + 1] ?? null;
        $downLeftChar = $input[$i + 1][$j - 1] ?? null;
        $downRightChar = $input[$i + 1][$j + 1] ?? null;
        if (
            null !== $upLeftChar &&
            null !== $downRightChar &&
            in_array($upLeftChar, ['M', 'S']) &&
            in_array($downRightChar, ['M', 'S']) &&
            $upLeftChar !== $downRightChar
        ) {
            $upLeft = true;
            $downRight = true;
        }
        if (
            null !== $upRightChar &&
            null !== $downLeftChar &&
            in_array($upRightChar, ['M', 'S']) &&
            in_array($downLeftChar, ['M', 'S']) &&
            $upRightChar !== $downLeftChar
        ) {
            $upRight = true;
            $downLeft = true;
        }

        if ($current && $upLeft && $upRight && $downLeft && $downRight) {
            $count++;
        }
    }
}

var_dump($count);
