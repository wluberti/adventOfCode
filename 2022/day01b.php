<?php

$sourceFile = "day01_input.txt";
$elfArray = [];
$currentElf = 0;

foreach(file($sourceFile) as $line) {
    $currentElf = $currentElf + intval($line);

    if ($line === PHP_EOL) {
        $elfArray[] = $currentElf;
        $currentElf = 0;
    }
}

echo "Highest = " . max($elfArray) . PHP_EOL;

echo "Top 3 combined = ";
rsort($elfArray);

echo array_sum(array_chunk($elfArray, 3)[0]) . PHP_EOL;