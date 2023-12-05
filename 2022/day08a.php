<?php

$sourceFile = 'day08_input.txt';
$grid = [];
$visibleTrees = 0;
$lastFoundHorizontalPosition = 0;
$lastFoundVerticalPosition = 0;

// Process input file
foreach(file($sourceFile) as $rowNumber => $line) {
    // Clean up linebreaks
    $line = trim($line);

    foreach (str_split($line) as $index => $value) {
        $grid[$rowNumber][$index] = intval($value);
    }
}

var_dump($grid);
exit();

foreach ($grid as $rowIndex => $rowValues) {
    // Count the top and bottom rows
    if ($rowIndex === 0 || $rowIndex === count($rowValues) -1) {
        $visibleTrees += count($rowValues);
        continue;
    }

    // Count horizontal visible trees
    $visibleTrees += findHorizontalOuterEdgeVisibleTrees($rowValues);
    $visibleTrees += findHorizontalOuterEdgeVisibleTrees($rowValues, true);

    // Count the vertical visible trees


    print "-- next row -- ({$visibleTrees})" . PHP_EOL;
}



function findHorizontalOuterEdgeVisibleTrees($rowValues, $reverse = false): int {
    $foundNumberOfVisibleTrees = 0;
    $previousValues = [];

    if ($reverse) { $rowValues = array_reverse($rowValues); }

    // Check from left to right
    foreach ($rowValues as $columnIndex => $columnValue) {
        // Count the outsides of the columns
        if (!$reverse && ($columnIndex === 0 || $columnIndex === count($rowValues) - 1)) {
            $foundNumberOfVisibleTrees++;
            continue;
        }

        // Check trees from the left
        if (empty($previousValues)) {
            $previousValues[] = $columnValue;
            if (!$reverse) { $lastFoundHorizontalPosition = $columnIndex; }
            $foundNumberOfVisibleTrees++;
            if ($reverse) {
                print "added last value ({$columnValue}) to previous values" . PHP_EOL;
            } else {
                print "added first value ({$columnValue}) to previous values" . PHP_EOL;
            }
        }

        if ($columnValue < max($previousValues)) {
            break;
        }

        if (!in_array($columnValue, $previousValues)) {
            $previousValues[] = $columnValue;
            if (!$reverse) { $lastFoundHorizontalPosition = $columnIndex; }
            $foundNumberOfVisibleTrees++;
        }
    }

    return $foundNumberOfVisibleTrees;
}

print ($visibleTrees);