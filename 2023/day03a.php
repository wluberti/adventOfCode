<?php

$data = file(__DIR__ . "/day03_input.txt");

function findSymbols(array $data): array {
    $symbols = [];
    foreach ($data as $line => $details) {
        // To filter out the symbols, change all digits and points to whitespace
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
                    'value' => $number,
                    'coordinates' => buildNumberCoordinateMatrix([
                        'line' => $line,
                        'column' => strpos($details, $number),
                        'length' => strlen($number),
                    ])
                ];
            }
        }
    }

    return $numbers;
}

/**
 * @param array $position Position of the first digit / symbol
 * @return array
 */
function buildNumberCoordinateMatrix(array $position): array {
    $coordinates = [];

    // line before position
    if ($position['line'] != 0 ) {
        for ($offset = -1; $offset <= $position['length'] ; $offset++) {
            $coordinates[] = [
                'line' => $position['line'] - 1,
                'column' => $position['column'] + $offset
            ];
        }
    }
    // line at current position
    for ($offset = -1; $offset <= $position['length'] ; $offset++) {
        $coordinates[] = [
            'line' => $position['line'],
            'column' => $position['column'] + $offset
        ];
    }
    // line after position
    if ($position['line'] != 139 ) {
        for ($offset = -1; $offset <= $position['length'] ; $offset++) {
            $coordinates[] = [
                'line' => $position['line'] + 1,
                'column' => $position['column'] + $offset
            ];
        }
    }

    return $coordinates;
}

function findTouches(array $symbols, array $numberCoordinates): int {
    $result = 0;
    foreach ($numberCoordinates as $number) {
        foreach ($number['coordinates'] as $coordinate) {
            foreach ($symbols as $symbol) {
                if (
                    $coordinate['line'] == $symbol['line']
                    and $coordinate['column'] == $symbol['column']
                ) {
                    $result += $number['value'];
                }
            }
        }
    }

    return $result;
}

$symbols = findSymbols($data);
//print_r($symbols);
$numbers = findNumbers($data);
//print_r($numbers);

print ('Total ==> ' . findTouches($symbols, $numbers) . PHP_EOL);