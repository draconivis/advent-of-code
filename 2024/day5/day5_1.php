<?php

$file = fopen('input', 'r');

// $rules = [
//     ['before' => 47, 'after' => 53],
//     ['before' => 97, 'after' => 13],
//     ['before' => 97, 'after' => 61],
//     ['before' => 97, 'after' => 47],
//     ['before' => 75, 'after' => 29],
//     ['before' => 61, 'after' => 13],
//     ['before' => 75, 'after' => 53],
//     ['before' => 29, 'after' => 13],
//     ['before' => 97, 'after' => 29],
//     ['before' => 53, 'after' => 29],
//     ['before' => 61, 'after' => 53],
//     ['before' => 97, 'after' => 53],
//     ['before' => 61, 'after' => 29],
//     ['before' => 47, 'after' => 13],
//     ['before' => 75, 'after' => 47],
//     ['before' => 97, 'after' => 75],
//     ['before' => 47, 'after' => 61],
//     ['before' => 75, 'after' => 61],
//     ['before' => 47, 'after' => 29],
//     ['before' => 75, 'after' => 13],
//     ['before' => 53, 'after' => 13],
// ];
// $updates = [
//     [75,47,61,53,29],
//     [97,61,53,29,13],
//     [75,29,13],
//     [75,97,47,61,53],
//     [61,13,29],
//     [97,13,75,29,47],
// ];

$rules = [];
$updates = [];
$rulesDone = false;
while (!feof($file)) {
    while (!$rulesDone) {
        $line = fgets($file);
        if ("\n" === $line) {
            $rulesDone = true;
            break;
        }
        preg_match_all('/\d{2}/', $line, $matches);
        $rules[] = ['before' => $matches[0][0], 'after' => $matches[0][1]];
    }
    $updates[] =  array_map(fn ($elem) => (int) $elem, array_filter(explode(',', fgets($file)), fn ($elem) => "\n" !== $elem));
}

$sum = 0;
foreach ($updates as $update) {
    $valid = true;
    foreach ($update as $pageNumber) {
        if (!$valid) {
            break;
        }
        foreach ($rules as ['before' => $before, 'after' => $after]) {
            if (!$valid) {
                break(2);
            }
            if (is_int(array_search($before, $update)) && is_int(array_search($after, $update)) && array_search($before, $update) >= array_search($after, $update)) {
                $valid = false;
            }
        }
    }
    if ($valid) {
        $sum += $update[floor(count($update) / 2)];
    }
}

var_dump($sum);
