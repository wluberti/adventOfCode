<?php

$data = file(__DIR__ . '/day01_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    list($left[], $right[]) = explode('   ', trim($line));
}

// Count all values in $right
$right = array_count_values($right);

// Multiply each value in $left with the corresponding number of occurrences in $right
foreach ($left as $value) {
    if (array_key_exists($value, $right)) {
        $total += $value * $right[$value];
    }
}

print $total . PHP_EOL;