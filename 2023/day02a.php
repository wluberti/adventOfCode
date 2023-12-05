<?php

$data = file(__DIR__ . "/day02_input.txt");

function disectGame(string $gameData):int {
    $maxCubes = [
        'red' => 12,
        'green' => 13,
        'blue' => 14,
    ];

    preg_match("/^Game (?'gameId'\d+):.(?'gameData'.*)$/", $gameData, $matches);
    $rounds = explode(';', $matches['gameData']);

    foreach ($rounds as $round) {
        $cubes = explode(',', $round);
        foreach ($cubes as $cube) {
            preg_match("/(?'amount'\d+) (?'color'\w+)/", $cube, $game);
            if ($game['amount'] > $maxCubes[$game['color']]) {
                return 0;
            }
        }
    }

    return intval($matches['gameId']);
}

$total = 0;
foreach ($data as $game) {
    $total += disectGame($game);
}

print('Total: ' . $total . PHP_EOL);