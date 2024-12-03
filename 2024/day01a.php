<?php

$data = file(__DIR__ . '/day01_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    list($left[], $right[]) = explode('   ', trim($line));
}

// Sort left and right
sort($left);
sort($right);

// Add up the differences
foreach ($left as $index => $value) {
    $total += abs($value - $right[$index]);
}

print $total . PHP_EOL;