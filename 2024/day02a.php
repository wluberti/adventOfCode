<?php

$data = file(__DIR__ . '/day02_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    $reports[] = explode(' ', trim($line));
}

foreach ($reports as $report) {
    foreach ($report as $index => $level) {
        if ($index === 0) continue; // we can only compare if we have a previous level

        // Skip this report if distance is not 1, 2 or 3
        if (!in_array(abs($level - $report[$index - 1]), [1, 2, 3])) {
            continue(2);
        }

        // Only compare if this is the last level in report
        if ($index === count($report) - 1) {
            // Sort the report
            $increasing = $report;
            sort($increasing);

            // Reverse the report
            $decreasing = $report;
            rsort($decreasing);

            // Check is a (reverse) sort matches the original report (hence is increasing or decreasing)
            if ($report === $increasing || $report === $decreasing) {
                $total++;
            };
        }
    }
}

print $total . PHP_EOL;