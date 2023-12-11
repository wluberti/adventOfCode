<?php

$data = file(__DIR__ . '/day04_input.txt');

$beginCards = [];
$wonCards = [];

// Build initial deck
foreach ($data as $line) {
    preg_match_all('/\b\d+\b/', $line, $matches);

    $winningNumbers = array_slice($matches[0], 1, 10);
    $drawNumbers = array_slice($matches[0], 11);
    $numberOfWins = count(array_intersect($winningNumbers, $drawNumbers));

    $beginCards[] = [
        'cardNumber' => intval($matches[0][0]),
        'winningNumbers' => $winningNumbers,
        'drawNumbers' => $drawNumbers,
        'numberOfWins' => $numberOfWins,
    ];
}

function calculateCards(array $gameData, array $allData): int {
    $total = 0;

    foreach ($gameData as $game) {
        $wins = $game['numberOfWins'];
        if ($wins > 0) {
            $newGames = array_slice($allData, $game['cardNumber'], $wins);
            $total += calculateCards($newGames, $allData);
        }
        $total++;
    }
    return $total;
}

print calculateCards($beginCards, $beginCards) . PHP_EOL;
