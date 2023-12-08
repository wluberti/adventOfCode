<?php

$data = file(__DIR__ . "/day03_input.txt");

function findSymbols(array $data): array {
    $symbols = [];
    foreach ($data as $index => $details) {
        // To filter out the symbols, change all digits and dots to a space
        $details = preg_replace("/[.\d]/", ' ', $details);
        // So everything that is not a dot is a symbol. Unify them to 'x'
        $details = preg_replace("/\S/", 'x', $details);

        // Find coordinates of symbols
        preg_match_all('/x/', $details, $allMatches, PREG_OFFSET_CAPTURE);
        foreach ($allMatches as $matchesPerLine) {
            foreach ($matchesPerLine as $match) {
                // +1 on line and column for troubleshoot
                $symbols[] = [
                    'line' => intval($index + 1),
                    'column' => intval($match[1] + 1),
                ];
            }
        }
    }

    return $symbols;
}

function findNumbers(array $data): array {
    $numbers = [];
    foreach ($data as $index => $details) {
        preg_match_all("/\d+/", $details, $matches);
        foreach ($matches as $numbersFound) {
            foreach ($numbersFound as $number) {
                // +1 on line and column for troubleshoot
                $numbers[] = [
                    'value' => $number,
                    'coordinates' => buildNumberBubble([
                        'line' => intval($index + 1),
                        'column' => strpos($details, $number) + 1,
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
function buildNumberBubble(array $coordinate): array {
    $coordinates = [];

    for ($yPosition = -1; $yPosition <= 1; $yPosition++) {
        for ($xPosition = -1; $xPosition <= $coordinate['length']; $xPosition++) {
            $coordinates[] = [
                'line' => intval($coordinate['line']) + $yPosition,
                'column' => intval($coordinate['column']) + $xPosition,
            ];
        }
    }

    return $coordinates;
}

function findTouches(array $symbolArray, array $numbersArray): int {
    $result = 0;

    foreach ($numbersArray as $numberBubble) {
        foreach ($numberBubble['coordinates'] as $coordinate) {
            foreach ($symbolArray as $symbol) {
                if (
                    $coordinate['line'] == $symbol['line']
                    and $coordinate['column'] == $symbol['column']
                ) {
                    $result += $numberBubble['value'];
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

//print_r(strpos('620123', '620'));

// not 551046 (too low)
// not 562163
// not 596001
// not 560884
// not 579281
// not 612751
// not 629533
