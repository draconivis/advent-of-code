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
		$validCount++;
	}
}

var_dump($validCount-1); // -1 because the file reading has an empty last line, which is also considered valid for some reason
