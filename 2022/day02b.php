<?php

$sourceFile = 'day02_input.txt';
$nameTable = [
    'A' => 'Rock',
    'B' => 'Paper',
    'C' => 'Scissors',
    'X' => 'Loose',
    'Y' => 'Draw',
    'Z' => 'Win',
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

    $outcome = determineWin($theirChoice, $yourChoice);
    $points = $pointsTable[$nameTable[$yourChoice]] + $pointsTable[$outcome];

    return $points ?? 0;
}

function determineWin(string $theirChoice, string $desiredOutcome): string {
    global $nameTable;

    // Draw scenario
    if ($nameTable[$desiredOutcome] === 'Draw') { return $nameTable[$theirChoice]; }

    // You loose scenario's
    if ($nameTable[$desiredOutcome] === 'Loose') {
        if ($nameTable[$theirChoice] === 'Rock') { return 'Scissors'; }
        if ($nameTable[$theirChoice] === 'Paper') { return 'Rock'; }
        if ($nameTable[$theirChoice] === 'Scissors') { return 'Paper'; }
    }

    // Else you Win :-)
    if ($nameTable[$desiredOutcome] === 'Win') {
        if ($nameTable[$theirChoice] === 'Rock') { return 'Paper'; }
        if ($nameTable[$theirChoice] === 'Paper') { return 'Scissors'; }
        if ($nameTable[$theirChoice] === 'Scissors') { return 'Rock'; }
    }
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
