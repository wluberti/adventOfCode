<?php

$sourceFile = "day01_input.txt";
$highestValue = 0;
$currentElf = 0;

foreach(file($sourceFile) as $line) {
    $currentElf = $currentElf + intval($line);
    echo intval($line);

    if ($line === PHP_EOL) {
        $highestValue = max($currentElf, $highestValue);
        $currentElf = 0;
    }
}

echo "Highest = " . $highestValue . PHP_EOL;