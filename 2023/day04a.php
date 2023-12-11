<?php

$data = file(__DIR__ . '/day04_input.txt');

$total = 0;

foreach ($data as $line) {
    preg_match_all('/\b\d+\b/', $line, $matches);

    $winningNumbers = array_slice($matches[0], 1, 10);
    $drawNumbers = array_slice($matches[0], 11);

    $numberOfWins = count(array_intersect($winningNumbers, $drawNumbers));

    if ($numberOfWins > 1) {
        $total += pow(2, $numberOfWins -1);
    } elseif ($numberOfWins === 1) {
        $total += 1;
    }
}

print $total . PHP_EOL;
