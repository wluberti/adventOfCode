<?php

$data = file(__DIR__ . "/day03_input.txt");

function findSymbols(array $data): array {
    $symbols = [];
    foreach ($data as $line => $details) {
        // Clean up
        $details = preg_replace("/[.\d]/", ' ', $details);
        // Unify symbols
        $details = preg_replace("/\S/", '*', $details);
        // Find coordinates of symbols
        if (strpos($details, '*')) {
            $symbols[] = [
                'line' => $line,
                'column' => strpos($details, '*'),
            ];
        }
    }

    return $symbols;
}

function findNumbers(array $data): array {
    $numbers = [];
    foreach ($data as $line => $details) {
        preg_match_all("/\d+/", $details, $matches);
        foreach ($matches as $numbersFound) {
            foreach ($numbersFound as $number) {
                $numbers[] = [
                    'line' => $line,
                    'column' => strpos($details, $number),
                    'value' => $number,
                ];
            }
        }
    }

    return $numbers;
}

function findNeighbours(array $symbols, array $numbers) {
    foreach ($symbols as $symbol) {
        $searchRange = [
            'minLine' => $symbol['line'] - 1,
            'maxLine' => $symbol['line'] + 1,
            'minColumn' => $symbol['column'] - 1,
            'maxColumn' => $symbol['column'] + 1,
        ];

        
    }
}

//$symbols = findSymbols($data);
//print_r($symbols);
$numbers = findNumbers($data);
print_r($numbers);