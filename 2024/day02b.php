<?php

$data = file(__DIR__ . '/day02_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    $reports[] = array_map('intval', explode(' ', trim($line)));
}


function safe(array $levels): bool {
    $diffs = [];
    for ($i = 0; $i < count($levels) - 1; $i++) {
        $diffs[] = $levels[$i] - $levels[$i + 1];
    }
    return all($diffs, fn($x) => $x >= 1 && $x <= 3) || all($diffs, fn($x) => $x <= -1 && $x >= -3);
}

function all(array $array, callable $callback): bool {
    foreach ($array as $item) {
        if (!$callback($item)) {
            return false;
        }
    }
    return true;
}

$inputFile = fopen("day02_input.txt", "r");

foreach ($reports as $levels) {
    $safeFound = false;

    for ($index = 0; $index < count($levels); $index++) {
        $filteredLevels = array_merge(
            array_slice($levels, 0, $index),
            array_slice($levels, $index + 1)
        );

        if (safe($filteredLevels)) {
            $safeFound = true;
            break;
        }
    }

    if ($safeFound) {
        $total++;
    }
}

print "$total\n";
