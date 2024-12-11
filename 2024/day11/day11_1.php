<?php

$file = fopen('input', 'r');
$line = fgets($file);
$input = explode(' ', trim($line));
// $input = ['125', '17'];

for ($i = 1; $i <= 25; $i++) {
    // Temporarily hold the modified array
    $newInput = [];

    foreach ($input as $j => $stone) {
        if ('0' === $stone) {
            $newInput[] = '1';
        } elseif (0 === strlen($stone) % 2) {
            $halfLen = strlen($stone) / 2;

            // Split into halves and trim leading zeros
            $leftHalf = ltrim(substr($stone, 0, $halfLen), '0');
            $rightHalf = ltrim(substr($stone, $halfLen), '0');

            // Add trimmed halves back into the array
            $newInput[] = $leftHalf ?: '0';
            $newInput[] = $rightHalf ?: '0';
        } else {
            $newInput[] = (string)((int)$stone * 2024);
        }
    }

    // Replace input with newInput for the next iteration
    $input = $newInput;
}

var_dump(count($input));
