<?php

$data = file(__DIR__ . '/day01_input.txt');

function extractCalibration(string $input): int {
    preg_match("/(\d)(.*(\d))?/", $input, $matches);
    return intval($matches[1] . end($matches));
}

$total = 0;

foreach ($data as $line) {
    $total += extractCalibration($line);
}

print $total . PHP_EOL;