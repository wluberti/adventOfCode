<?php

$data = file('day06_input.txt')[0];
$dataArray = str_split($data);
$startPackageFound = false;

foreach ($dataArray as $index => $_) {
    // Need 4 characters before to start, skip before that
    if($index < 3) { continue ; }

    // Count amount of unique characters in a 4 character slice to find start of package
    if(!$startPackageFound && count(array_unique(array_slice($dataArray, $index, 4))) == 4) {
        // Add 4 to get end of the range
        echo 'Start of package: ' . $index + 4 . PHP_EOL;
        $startPackageFound = true;
    }

    // Count amount of unique characters in a 4 character slice to find start of message
    if(count(array_unique(array_slice($dataArray, $index, 14))) == 14) {
        // Add 14 to get end of the range
        echo 'Start of message: ' . $index + 14 . PHP_EOL;
        exit(0);
    }
}
