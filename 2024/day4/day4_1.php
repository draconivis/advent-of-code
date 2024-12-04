<?php

$file = fopen('input', 'r');

// $input = [
// 	['M', 'M', 'M', 'S', 'X', 'X', 'M', 'A', 'S', 'M' ],
// 	['M', 'S', 'A', 'M', 'X', 'M', 'S', 'M', 'S', 'A' ],
// 	['A', 'M', 'X', 'S', 'X', 'M', 'A', 'A', 'M', 'M' ],
// 	['M', 'S', 'A', 'M', 'A', 'S', 'M', 'S', 'M', 'X' ],
// 	['X', 'M', 'A', 'S', 'A', 'M', 'X', 'A', 'M', 'M' ],
// 	['X', 'X', 'A', 'M', 'M', 'X', 'X', 'A', 'M', 'A' ],
// 	['S', 'M', 'S', 'M', 'S', 'A', 'S', 'X', 'S', 'S' ],
// 	['S', 'A', 'X', 'A', 'M', 'A', 'S', 'A', 'A', 'A' ],
// 	['M', 'A', 'M', 'M', 'M', 'X', 'M', 'M', 'M', 'M' ],
// 	['M', 'X', 'M', 'X', 'A', 'X', 'M', 'A', 'S', 'X' ],
// ];
$input = [];
while (!feof($file)) {
    $input[] = array_filter(str_split(fgets($file)), fn ($elem) => "\n" !== $elem);
}

function buildHorizontal(array $line, int $index): bool
{
    // if ($index > count($line)-4) return false;
    $subline = array_slice(array: $line, offset: $index, length: 4);
    $match = implode($subline);
    return 'XMAS' === $match;
}

function buildBackwards(array $line, int $index): bool
{
    if ($index < 3) {
        return false;
    }
    $subline = array_reverse(array_slice(array: $line, offset: $index - 3, length: 4));
    $match = implode($subline);
    return 'XMAS' === $match;
}

function buildVerticalDown(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx > count($input)-5) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx + $offset][$lineIdx])) {
            $match .= $input[$inputIdx + $offset][$lineIdx];
        }
    }
    return 'XMAS' === $match;
}

function buildVerticalUp(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx < 4) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx - $offset][$lineIdx])) {
            $match .= $input[$inputIdx - $offset][$lineIdx];
        }
    }
    return 'XMAS' === $match;
}

function buildDiagonalDownLeft(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx > count($input)-5 || $lineIdx < 4) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx + $offset][$lineIdx - $offset])) {
            $match .= $input[$inputIdx + $offset][$lineIdx - $offset];
        }
    }
    return 'XMAS' === $match;
}
function buildDiagonalDownRight(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx > count($input)-5 || $lineIdx > count($input[$inputIdx])-5) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx + $offset][$lineIdx + $offset])) {
            $match .= $input[$inputIdx + $offset][$lineIdx + $offset];
        }
    }
    return 'XMAS' === $match;
}

function buildDiagonalUpLeft(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx < 4 || $lineIdx < 4) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx - $offset][$lineIdx - $offset])) {
            $match .= $input[$inputIdx - $offset][$lineIdx - $offset];
        }
    }
    return 'XMAS' === $match;
}
function buildDiagonalUpRight(array $input, int $inputIdx, int $lineIdx): string
{
    // if ($inputIdx < 4 || $lineIdx > count($input[$inputIdx])-5) return false;
    $match = $input[$inputIdx][$lineIdx];
    foreach (range(1, 3) as $offset) {
        if (isset($input[$inputIdx - $offset][$lineIdx + $offset])) {
            $match .= $input[$inputIdx - $offset][$lineIdx + $offset];
        }
    }
    return 'XMAS' === $match;
}

$count = 0;

foreach ($input as $i => $line) {
    foreach ($line as $j => $char) {
        if (buildHorizontal(line: $line, index: $j)) {
            $count++;
        }
        if (buildBackwards(line: $line, index: $j)) {
            $count++;
        }
        if (buildVerticalDown(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
        if (buildVerticalUp(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
        if (buildDiagonalDownLeft(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
        if (buildDiagonalDownRight(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
        if (buildDiagonalUpLeft(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
        if (buildDiagonalUpRight(input: $input, inputIdx: $i, lineIdx: $j)) {
            $count++;
        }
    }
}

var_dump($count);
