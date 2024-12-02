<?php

$file = fopen('input', 'r');

$numbers = [];
while (!feof($file)) {
	$line = fgets($file);
	$lineNumbers = explode(' ', $line);
	$numbers[] = array_map(fn ($number) => (int) $number, $lineNumbers);
}

function checkSafe(array $reportNumbers): bool {
	$prevNumber = null;
	$isAscending = null;
	$isValid = true;
	foreach ($reportNumbers as $key => $number) {
		if (!$isValid) {
			break;
		}
		if ($prevNumber === null) {
			$prevNumber = $number;
			continue;
		}
		if (null === $isAscending ){
			if ($number < $prevNumber) {
				$isAscending = false;
			} elseif ($number > $prevNumber) {
				$isAscending = true;
			} else {
				$isValid = false;
				break;
			}
		}
		if ($isAscending && $number > $prevNumber && 1 <= ($number - $prevNumber) && ($number - $prevNumber) <= 3){
			$prevNumber = $number;
		} elseif (!$isAscending && $number < $prevNumber && 1 <= ($prevNumber - $number) && ($prevNumber - $number) <= 3) {
			$prevNumber = $number;
		} else {
			$isValid = false;
		}
	}

	return $isValid;
}

$validCount = 0;
foreach ($numbers as $reportNumbers) {
	if (checkSafe($reportNumbers)) {
		var_dump($reportNumbers);
		$validCount++;
	} else {
		foreach (range(0, count($reportNumbers)-1) as $i) {
			// this doesn't work bc it can remove multiple values
			// ie [1, 4, 4, 5], would result in [1, 5]
			// $tempArr = array_diff($reportNumbers, [$reportNumbers[$i]]); 
			$tempArr = array_values($reportNumbers);
			unset($tempArr[$i]);
			if (checkSafe($tempArr)) {
				var_dump($tempArr);
				$validCount++;
				break;
			}
		}
	}
}

var_dump($validCount-1);
