<?php

// $input = [
//     "190: 10 19",
//     "3267: 81 40 27",
//     "83: 17 5",
//     "156: 15 6",
//     "7290: 6 8 6 15",
//     "161011: 16 10 13",
//     "192: 17 8 14",
//     "21037: 9 7 18 13",
//     "292: 11 6 16 20"
// ];

$file = fopen('input', 'r');
$input = [];
while (!feof($file)) {
    $input[] = fgets($file);
}

// Function to evaluate an expression with left-to-right order
function evaluateExpression($numbers, $operators)
{
    $expectedResult = $numbers[0]; // Start with the first number
    for ($i = 0; $i < count($operators); $i++) {
        switch ($operators[$i]) {
            case '+':
                $expectedResult += $numbers[$i + 1];
                break;
            case '*':
                $expectedResult *= $numbers[$i + 1];
                break;
            case '||':
                // Concatenate the numbers as strings and then convert back to int
                $expectedResult = (int)($expectedResult . $numbers[$i + 1]);
                break;
        }
    }
    return $expectedResult;
}

// Function to generate all possible operator combinations
function generateOperatorCombinations(int $count)
{
    $combinations = [];
    $max = pow(3, $count); // 2^count possible combinations
    for ($i = 0; $i < $max; $i++) {
        $ternary = str_pad(base_convert($i, 10, 3), $count, '0', STR_PAD_LEFT); // Convert to ternary and pad
        $operators = [];
        for ($j = 0; $j < $count; $j++) {
            $operator = $ternary[$j];
            $operators[] = $operator === '0' ? '+' : ($operator === '1' ? '*' : '||');
        }
        $combinations[] = $operators;
    }
    return $combinations;
}


$sum = 0;
foreach ($input as $line) {
    [$expectedResult, $numbersString] = explode(':', $line);
    $expectedResult = (int)trim($expectedResult);
    $numbers = array_map('intval', explode(' ', trim($numbersString)));

    // Number of operators to insert (one less than the number of numbers)
    $operatorCount = count($numbers) - 1;

    // Generate all possible combinations of operators
    $operatorCombinations = generateOperatorCombinations($operatorCount);

    // Check if any operator combination gives the correct result
    $foundValidEquation = false;
    foreach ($operatorCombinations as $operators) {
        if ($expectedResult === $result = evaluateExpression($numbers, $operators)) {
            $sum += $result;
            break;
        }
    }
}

var_dump($sum);
