<?php

$sourceFile = 'day04_input.txt';
$diff = [];

function expandRange($range): array {
    [$begin, $end] = explode('-', $range);
    return range($begin, $end);
}

function rangeInRange($range1, $range2): bool {
    $range1 = expandRange($range1);
    $range2 = expandRange($range2);

    if (count($range1) > count($range2)) {
        return !array_diff($range2, $range1);
    } else {
        return !array_diff($range1, $range2);
    }
}

function rangeOverlap($range1, $range2): bool {
    $range1 = expandRange($range1);
    $range2 = expandRange($range2);

    return count(array_intersect($range1, $range2)) > 0;
}

foreach(file($sourceFile) as $line) {
    [$elf1, $elf2] = explode(',', trim($line));
    $diff[] = rangeInRange($elf1, $elf2);

    if (!rangeInRange($elf1, $elf2)) {
        $diff[] = rangeOverlap($elf1, $elf2);
    }
}

print(array_sum($diff) . PHP_EOL);
