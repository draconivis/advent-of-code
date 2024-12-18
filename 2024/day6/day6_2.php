<?php

// $map = [
//     ['.', '.', '.', '.', '#', '.', '.', '.', '.', '.'],
//     ['.', '.', '.', '.', '.', '.', '.', '.', '.', '#'],
//     ['.', '.', '.', '.', '.', '.', '.', '.', '.', '.'],
//     ['.', '.', '#', '.', '.', '.', '.', '.', '.', '.'],
//     ['.', '.', '.', '.', '.', '.', '.', '#', '.', '.'],
//     ['.', '.', '.', '.', '.', '.', '.', '.', '.', '.'],
//     ['.', '#', '.', '.', '^', '.', '.', '.', '.', '.'],
//     ['.', '.', '.', '.', '.', '.', '.', '.', '#', '.'],
//     ['#', '.', '.', '.', '.', '.', '.', '.', '.', '.'],
//     ['.', '.', '.', '.', '.', '.', '#', '.', '.', '.'],
// ];

$file = fopen('input', 'r');
$map = [];
while (!feof($file)) {
    $row = str_split(fgets($file));
    if (!empty($row)) {
        $map[] = array_filter($row, fn ($elem) => "\n" !== $elem);
    }
}

$xPos = 0;
$yPos = 0;
foreach ($map as $i => $row) {
    $pos = array_search('^', $row);
    if (is_int($pos)) {
        $xPos = $pos;
        $yPos = $i;
    }
}

function getPositions($map, $yPos, $xPos)
{
    $direction = '^';
    $outOfBounds = false;
    $iter = 0;
    while (!$outOfBounds && 16900 >= $iter) {
        $iter++;
        switch ($direction) {
            case '^':
                // Check if out of bounds (above the current row)
                if (!isset($map[$yPos - 1][$xPos])) {
                    $outOfBounds = true;
                } elseif ('#' === $map[$yPos - 1][$xPos]) {
                    $direction = '>';  // Turn right
                } else {
                    $yPos--;  // Move up
                }
                break;
            case '>':
                // Check if out of bounds (right of the current column)
                if (!isset($map[$yPos][$xPos + 1])) {
                    $outOfBounds = true;
                } elseif ('#' === $map[$yPos][$xPos + 1]) {
                    $direction = 'v';  // Turn down
                } else {
                    $xPos++;  // Move right
                }
                break;
            case 'v':
                // Check if out of bounds (below the current row)
                if (!isset($map[$yPos + 1][$xPos])) {
                    $outOfBounds = true;
                } elseif ('#' === $map[$yPos + 1][$xPos]) {
                    $direction = '<';  // Turn left
                } else {
                    $yPos++;  // Move down
                }
                break;
            case '<':
                // Check if out of bounds (left of the current column)
                if (!isset($map[$yPos][$xPos - 1])) {
                    $outOfBounds = true;
                } elseif ('#' === $map[$yPos][$xPos - 1]) {
                    $direction = '^';  // Turn up
                } else {
                    $xPos--;  // Move left
                }
                break;
        }
    }

    return !$outOfBounds;
}

$count = 0;
foreach ($map as $i => $row) {
    foreach ($row as $j => $char) {
        if ('.' !== $char) {
            continue;
        }

        $tempMap = array_values($map);
        $tempMap[$i][$j] = '#';

        if (getPositions($tempMap, $yPos, $xPos)) {
            $count++;
        }
    }
}

var_dump($count);
