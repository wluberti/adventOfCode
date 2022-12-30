<?php

$sourceFile = 'day05_input.txt';
$instructions = [];
$grid = [];
$result = '';

// Process input file
foreach(file($sourceFile) as $line) {
    if (str_starts_with($line, 'move')) {
        preg_match('/(?<amount>\d+)\D+(?<from>\d+)\D+(?<to>\d+)/', $line, $matches);
        $instructions[] = $matches;
    } elseif (trim($line) === '' || is_numeric(trim($line)[0])) {
        // Do nothing for empty lines or for line with column numbers
    } else {
        foreach (str_split($line, 4) as $columnNumber => $segmentValue) {
            // Align php count with actual column numbers
            $columnNumber++;

            // Create a list on $columnNumber on grid if it does not exist yet
            if (!isset($grid[$columnNumber])) { $grid[$columnNumber] = []; }

            // If $segmentValue contains a letter, add it to the beginning of the list
            $val = preg_replace('/[\W]/', false, $segmentValue);
            if ($val) { array_unshift($grid[$columnNumber], $val); }
        }
    }
}

function execute($instruction): void {
    global $grid;

    $grid[$instruction['to']] = array_merge(
        $grid[$instruction['to']],
        array_slice($grid[$instruction['from']], -$instruction['amount'], $instruction['amount'])
    );

    // Don't forget to pop the transferred elements
    foreach (range(1, $instruction['amount']) as $_) {
        array_pop($grid[$instruction['from']]);
    }

}

foreach ($instructions as $instruction) {
    execute($instruction);
}

foreach ($grid as $column => $values) {
    $result .= array_pop($grid[$column]);
}
print($result . PHP_EOL);
