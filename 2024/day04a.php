<?php

$file = file(__DIR__ . '/day04_input.txt');

// Filter the input
foreach ($file as $line) {
    $data[] = str_split(trim($line));
}

function checkCoordinates(int $column, int $row): int {
    global $data;
    $size = 139;
    $word = ['X', 'M', 'A', 'S'];
    $boundary = count($word) - 1;
    $found = 0;

    $directions = [
        [-1, -1], [-1, 0], [-1, 1],
        [0,  -1], [ 0, 0], [ 0, 1],
        [1,  -1], [ 1, 0], [ 1, 1],
    ];

    foreach ($directions as $direction) {
        $count = 0;

        foreach ($word as $index => $letter) {
            $x = $row + ($index * $direction[0]);
            $y = $column + ($index * $direction[1]);

            if ($x < $boundary && $direction[0] === -1) { continue; }
            if ($y < $boundary && $direction[1] === -1) { continue; }
            if ($x > $size - $boundary && $direction[0] === 1) { continue; }
            if ($y > $size - $boundary && $direction[1] === 1) { continue; }

            if ($data[$x][$y] == $letter) {
                $count++;
            }
        }

        if ($count == count($word)) { $found++; }
    }

    return $found;
}

$total = 0;

foreach ($data as $line => $letters) {
    foreach ($letters as $column => $letter) {
//        print('-----------------------' . PHP_EOL);
//        print("$line, $column" . PHP_EOL);
        $total += checkCoordinates($line, $column);
    }
}
print('-----------------------' . PHP_EOL);
print $total . PHP_EOL;

// 2402 too low
// 6333 too high