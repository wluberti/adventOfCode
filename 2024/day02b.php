<?php

$data = file(__DIR__ . '/day02_input.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    $reports[] = explode(' ', trim($line));
}

/**
 * Determines if the given report array is in an increasing or decreasing sequence.
 * @param array $report The array of numbers to check for sequence.
 * @return bool True if the array is in an increasing or decreasing sequence, false otherwise.
 */
function isSequence(array $report): bool {
    $increasing = $report;
    sort($increasing);  // Increasing sequence
    if ($report === $increasing) { return true; }

    $decreasing = $report;
    rsort($decreasing);  // Decreasing sequence
    if ($report === $decreasing) { return true; }

    return false;
}

function bruteForce(array $levels): array|false {
    $originalLevels = $levels;
    $result = false;
    foreach ($levels as $index => $level) {
        array_splice($levels, $index, 1);
        if (isSequence($levels)) {
            return $levels;
        }
    }


    return false;
}

foreach ($reports as $report) {
    $AllowProblemDampener = true;
    foreach ($report as $index => $level) {
        if ($index === 0) continue; // we can only compare if we have a previous level

        print('--' . PHP_EOL);
        print_r($report);

        if ($AllowProblemDampener) {
            // Filter out any distance that is not 1, 2 or 3
            if (!in_array(abs($level - $report[$index - 1]), [1, 2, 3])) {
                // Remove this level from the report and continue to next level
                array_splice($report, $index, 1);
                $AllowProblemDampener = false;
                print('Used problem dampener for index' . PHP_EOL);
                print_r($report);
                if ($index !== count($report) - 1) {
                    continue;
                }
            }
            if (!isSequence($report)) {
                bruteForce($report);
                array_splice($report, $index -1, 1);
                $AllowProblemDampener = false;
                print('Used problem dampener for sequence' . PHP_EOL);
                print_r($report);
            };
        }

        // Skip this report if distance is not 1, 2 or 3
        if (!in_array(abs($level - $report[$index - 1]), [1, 2, 3])) {
            if ($AllowProblemDampener) {
                $AllowProblemDampener = false;
            }
            continue(2);
        }

        // Only compare if this is the last level in report
        if (isSequence($report) && $index === count($report) - 1) {
            print('@@@@@@@@@@@@@ Saved @@@@@@@@@@@@@' . PHP_EOL);
            print_r($report);
            $total++;
        }
    }
}

print "$total\n";