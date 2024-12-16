<?php

// Prepare the input
$file = file(__DIR__ . '/day04_input.txt');
foreach ($file as $line) {
    $data[] = str_split(trim($line));
}

// Function to check for "MAS" in all directions resembaling an X
function checkCoordinates(int $row, int $column): int {
    global $data;
    $found = 0;

    // no X-MAS to be found on the edges since A has to be in the middle
    if ($row === 0 || $row === count($data) - 1 || $column === 0 || $column === count($data[$row]) - 1) {
        return 0;
    }

    // All 4 X-directions: [row_offset, col_offset]
    $directions = [
        [-1, -1,  1, -1],
        [-1,  1, -1, -1],
        [ 1, -1, -1, -1],
        [-1, -1, -1,  1],
    ];

    foreach ($directions as [$a, $b, $c, $d]) {
        $word = '';
        $word .= $data[$row + $a][$column + $b];
        $word .= $data[$row][$column]; // A
        $word .= $data[$row + $c][$column + $d];
        $word .= $data[$row + -$a][$column + -$b];
        $word .= $data[$row][$column]; // A
        $word .= $data[$row + -$c][$column + -$d];

        print($word . PHP_EOL);

        if ( $word === 'SAMSAM' || $word === 'MASMAS' || $word === 'SAMMAS' || $word === 'MASSAM' ) {
            $found = 1;
        }
    }

    return $found;
}

$total = 0;

// Iterate through the grid and check for "XMAS"
foreach ($data as $line => $letters) {
    foreach ($letters as $index => $letter) {
        if ($letter === 'A') { // Optimization: Only start checking if the middle letter is 'A'
            $total += checkCoordinates($line, $index);
        }
    }
}

print('-----------------------' . PHP_EOL);
print $total . PHP_EOL;

// 980 is too low
// 1816 is too low
// 1949 is incorrect
// 4020 is too high