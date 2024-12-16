<?php

// Prepare the input
$file = file(__DIR__ . '/day04_input.txt');
foreach ($file as $line) {
    $data[] = str_split(trim($line));
}

// Code

function checkCoordinates(int $row, int $column): int {
    global $data;
    $size = 140;
    $word = ['X', 'M', 'A', 'S'];
    $offset = count($word) - 1;
    $found = 0;

    $directions = [
        [-1, -1], [-1, 0], [-1, 1],
        [0,  -1], [ 0, 0], [ 0, 1],
        [1,  -1], [ 1, 0], [ 1, 1],
    ];

    foreach ($directions as $direction) {
        $foundWord = [];

        foreach ($word as $index => $letter) {
            $rowInData = $row + ($index * $direction[0]);
            $columnInData = $column + ($index * $direction[1]);

            if ($rowInData < $offset && $direction[0] === -1) { continue(2); }
            if ($rowInData > $size - $offset && $direction[0] === 1) { continue(2); }

            if ($columnInData < $offset && $direction[1] === -1) { continue(2); }
            if ($columnInData > $size - $offset && $direction[1] === 1) { continue(2); }

            $foundWord[] = $data[$rowInData][$columnInData];
        }

        if ($foundWord === $word) {
            $found++;
        }
    }

    return $found;
}

$total = 0;

foreach ($data as $line => $letters) {
    foreach ($letters as $index => $letter) {
        $total += checkCoordinates($line, $index);
    }
}

print('-----------------------' . PHP_EOL);
print $total . PHP_EOL;

// 2402 too low
// 4838 not correct
// 6333 too high