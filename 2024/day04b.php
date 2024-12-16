<?php
$input = file('day04_input.txt', FILE_IGNORE_NEW_LINES);
$grid = [];
foreach ($input as $line) {
    $grid[] = str_split(trim($line));
}

$rows = count($grid);
$cols = count($grid[0]);

function countXMASCandidates(array $grid, int $rows, int $cols): int {
    $count = 0;
    for ($row = 0; $row < $rows - 2; $row++) {
        for ($col = 0; $col < $cols - 2; $col++) {
            if ( $grid[$row+1][$col+1] === 'A' && isXMAS($grid, $row, $col)) {
                $count++;
            }
        }
    }
    return $count;
}

function isXMAS($grid, $row, $col) {
    // Check the X pattern for two "MAS" or "SAM"
    return (
        (     $grid[$row  ][$col  ] === 'M' && $grid[$row+2][$col+2] === 'S' // Top-left to bottom-right MAS
           && $grid[$row+2][$col  ] === 'M' && $grid[$row  ][$col+2] === 'S' // Bottom-left to top-right MAS
        )
        || (   $grid[$row  ][$col  ] === 'S' && $grid[$row+2][$col+2] === 'M' // Top-left to bottom-right SAM
            && $grid[$row+2][$col  ] === 'S' && $grid[$row  ][$col+2] === 'M' // Bottom-left to top-right SAM
        )
        || (   $grid[$row  ][$col  ] === 'M' && $grid[$row+2][$col+2] === 'S' // Top-left to bottom-right MAS
            && $grid[$row+2][$col  ] === 'S' && $grid[$row  ][$col+2] === 'M' // Bottom-left to top-right SAM
        )
        || (   $grid[$row  ][$col  ] === 'S' && $grid[$row+2][$col+2] === 'M' // Top-left to bottom-right SAM
            && $grid[$row+2][$col  ] === 'M' && $grid[$row  ][$col+2] === 'S' // Bottom-left to top-right MAS
        )
    );
}

print (countXMASCandidates($grid, $rows, $cols) . PHP_EOL);