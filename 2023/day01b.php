<?php

$data = file(__DIR__ . '/day01_input.txt');

function extractCalibration(string $input): int {
    preg_match(
        "/(\d|one|two|three|four|five|six|seven|eight|nine)(.*(\d|one|two|three|four|five|six|seven|eight|nine))?/",
        $input,
        $matches
    );

    return intval(textToInt($matches[1]) . textToInt(end($matches)));
}

function textToInt(string $input): string {
    $text = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    return str_replace($text, $numbers, $input);
}

$total = 0;

foreach ($data as $line) {
    $total += extractCalibration($line);
}

print $total . PHP_EOL;
