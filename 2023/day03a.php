<?php

$data = file(__DIR__ . "/day03_input.txt");

function findSymbols(array $data): array {
    $symbols = [];
    foreach ($data as $line => $details) {
        // To filter out the symbols, change all digits and points to whitespace
        $details = preg_replace("/[.\d]/", ' ', $details);
        // Unify symbols as 'x'
        $details = preg_replace("/\S/", 'x', $details);

        // Find coordinates of symbols
        preg_match_all('/x/', $details, $allMatches, PREG_OFFSET_CAPTURE);
        foreach ($allMatches as $matchesPerLine) {
            foreach ($matchesPerLine as $match) {
                $symbols[] = [
                    'line' => $line,
                    'column' => $match[1],
                ];
            }
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
 * @param array $coordinate Coordinates of the first digit
 * @return array with all the coordinates surrounding the number (not just the first digit)
 */
function buildNumberCoordinateMatrix(array $coordinate): array {
    $coordinates = [];

    // Positions before line of number
    if ($coordinate['line'] != 0 ) {
        for ($offset = -1; $offset <= $coordinate['length'] ; $offset++) {
            $coordinates[] = [
                'line' => $coordinate['line'] - 1,
                'column' => $coordinate['column'] + $offset
            ];
        }
    }

    // Position left of number
    $coordinates[] = [
        'line' => $coordinate['line'],
        'column' => $coordinate['column'] - 1,
    ];
    // Position right of number
    $coordinates[] = [
        'line' => $coordinate['line'],
        'column' => $coordinate['column'] + $coordinate['length']
    ];

    // Positions after line of number
    if ($coordinate['line'] != 139 ) {
        for ($offset = -1; $offset <= $coordinate['length'] ; $offset++) {
            $coordinates[] = [
                'line' => $coordinate['line'] + 1,
                'column' => $coordinate['column'] + $offset
            ];
        }
    }

    return $coordinates;
}

function findTouches(array $symbolArray, array $numbersArray): int {
    $result = 0;
    foreach ($symbolArray as $symbol) {
        foreach ($numbersArray as $numberMatrix) {
            foreach ($numberMatrix['coordinates'] as $coordinate) {
                if (
                    $coordinate['line'] == $symbol['line']
                    and $coordinate['column'] == $symbol['column']
                ) {
                    $result += $numberMatrix['value'];
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

// not 551046 (too low)
// not 562163
// not 596001