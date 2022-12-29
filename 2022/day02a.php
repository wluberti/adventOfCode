<?php

$sourceFile = 'day02_input.txt';
$nameTable = [
    'A' => 'Rock',
    'B' => 'Paper',
    'C' => 'Scissors',
    'X' => 'Rock',
    'Y' => 'Paper',
    'Z' => 'Scissors',
];
$pointsTable = [
    'Rock' => 1,
    'Paper' => 2,
    'Scissors' => 3,
    'Loose' => 0,
    'Draw' => 3,
    'Win' => 6,
];

$totalScore = 0;

function determinePoints(string $theirChoice, string $yourChoice): int {
    global $pointsTable, $nameTable;

    $outcome = determineWin($theirChoice, $yourChoice, $nameTable);
    $points = $pointsTable[$nameTable[$yourChoice]] + $pointsTable[$outcome];

    return $points ?? 0;
}

function determineWin(string $theirChoice, string $yourChoice): string {
    global $nameTable;

    // Draw scenario
    if ($nameTable[$theirChoice] === $nameTable[$yourChoice]) { return 'Draw'; }

    // You loose scenario's
    if ($nameTable[$theirChoice] === 'Rock' && $nameTable[$yourChoice] == 'Scissors') { return 'Loose'; }
    if ($nameTable[$theirChoice] === 'Paper' && $nameTable[$yourChoice] == 'Rock') { return 'Loose'; }
    if ($nameTable[$theirChoice] === 'Scissors' && $nameTable[$yourChoice] == 'Paper') { return 'Loose'; }

    // Else you Win :-)
    return 'Win';
}

foreach(file($sourceFile) as $line) {
    $turn = explode(' ', trim($line));
    print("They play {$nameTable[$turn[0]]}, I play {$nameTable[$turn[1]]}.");
    print(" Rusult: " . determineWin($turn[0], $turn[1]));
    print(" Points: " . determinePoints($turn[0], $turn[1]));
    print PHP_EOL;

    $totalScore += determinePoints($turn[0], $turn[1]);
}

print $totalScore . PHP_EOL;
