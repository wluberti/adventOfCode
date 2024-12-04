<?php

$data = file(__DIR__ . '/day02_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    $reports[] = explode(' ', trim($line));
}

foreach ($reports as $report) {
    print ('-------- next report --------' . PHP_EOL);
    foreach ($report as $index => $level) {
        if ($index === 0) continue; // we can only compare if we have a previous level

        // Skip this report if distance is more than 3
        if (abs($level - $report[$index - 1]) > 3) {
            continue(2);
        }

        // Skip this report if distance is 0
        if (abs($level - $report[$index - 1]) === 0) {
            continue(2);
        }

        $increasing = $report;
        sort($increasing);

        $decreasing = $report;
        rsort($decreasing);

        if ($report === $increasing || $report === $decreasing) {
            // We have a match
            $total++;

            // Check output
            print_r($report);

            // Stop processing this report
            continue(2);
        };
    }
}

print "$total\n";