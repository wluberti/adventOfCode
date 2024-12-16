<?php

// Prepare the input
$file = file(__DIR__ . '/day04_input.txt');
foreach ($file as $line) {
    $data[] = str_split(trim($line));
}

// Function to check for "XMAS" in all 8 directions
function checkCoordinates(int $row, int $column): int {
    global $data;
    $word = ['X', 'M', 'A', 'S'];
    $found = 0;

    // All 8 directions: [row_offset, col_offset]
    $directions = [
        [-1, -1], [-1, 0], [-1, 1],
        [ 0, -1],          [ 0, 1],
        [ 1, -1], [ 1, 0], [ 1, 1]
    ];

    foreach ($directions as [$rowOffset, $colOffset]) {
        $matches = true;

        for ($index = 0; $index < count($word); $index++) {
            $newRow = $row + ($index * $rowOffset);
            $newCol = $column + ($index * $colOffset);

            // Check boundaries
            if ($newRow < 0 || $newRow >= count($data) || $newCol < 0 || $newCol >= count($data[$row])) {
                $matches = false;
                break;
            }

            if ($data[$newRow][$newCol] !== $word[$index]) {
                $matches = false;
                break;
            }
        }

        if ($matches) {
            $found++;
        }
    }

    return $found;
}

$total = 0;

// Iterate through the grid and check for "XMAS"
foreach ($data as $line => $letters) {
    foreach ($letters as $index => $letter) {
        if ($letter === 'X') { // Optimization: Only start checking if the letter is 'X'
            $total += checkCoordinates($line, $index);
        }
    }
}

print('-----------------------' . PHP_EOL);
print $total . PHP_EOL;
