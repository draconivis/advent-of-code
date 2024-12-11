<?php

// $input = [
//     [8,9,0,1,0,1,2,3],
//     [7,8,1,2,1,8,7,4],
//     [8,7,4,3,0,9,6,5],
//     [9,6,5,4,9,8,7,4],
//     [4,5,6,7,8,9,0,3],
//     [3,2,0,1,9,0,1,2],
//     [0,1,3,2,9,8,0,1],
//     [1,0,4,5,6,7,3,2],
// ];

$file = fopen('input', 'r');
$input = [];
while (!feof($file)) {
    $line = array_map('intval', str_split(trim(fgets($file), "\n")));
    if (!empty($line)) {
        $input[] = $line;
    }
}

// Global array to keep track of visited cells
$visited = [];

function checkNext($xPos, $yPos, $prev)
{
    global $input;

    return isset($input[$yPos][$xPos]) && $input[$yPos][$xPos] === ++$prev;
}

function checkPaths($xPos, $yPos)
{
    global $input, $visited;

    $curr = $input[$yPos][$xPos] ;

    if (isset($visited[$yPos][$xPos])) {
        return 0;
    }

    // Mark this cell as visited
    $visited[$yPos][$xPos] = true;

    if (9 === $curr) {
        return 1;
    }

    $score = 0;
    foreach (['l', 'u', 'r', 'd'] as $dir) {
        $score += match($dir) {
            'l' => checkNext(xPos: $xPos - 1, yPos: $yPos, prev: $curr) ? checkPaths(xPos: $xPos - 1, yPos: $yPos) : 0,
            'r' => checkNext(xPos: $xPos + 1, yPos: $yPos, prev: $curr) ? checkPaths(xPos: $xPos + 1, yPos: $yPos) : 0,
            'u' => checkNext(xPos: $xPos, yPos: $yPos - 1, prev: $curr) ? checkPaths(xPos: $xPos, yPos: $yPos - 1) : 0,
            'd' => checkNext(xPos: $xPos, yPos: $yPos + 1, prev: $curr) ? checkPaths(xPos: $xPos, yPos: $yPos + 1) : 0,
        };
    }

    return $score;
}

$sum = 0;
foreach ($input as $yPos => $row) {
    foreach ($row as $xPos => $char) {
        if (0 !== $char) {
            continue;
        }
        $visited = [];
        $score = checkPaths(xPos: $xPos, yPos: $yPos);
        $sum += $score;
    }
}

var_dump($sum);
