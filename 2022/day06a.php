<?php

$data = file('day06_input.txt')[0];
$dataArray = str_split($data);

foreach ($dataArray as $index => $_) {
    // Need 4 characters before to start, skip before that
    if($index < 3) { continue ; }

    // Count amout of unique characters in a 4 character slice
    if(count(array_unique(array_slice($dataArray, $index, 4))) == 4) {
        // Add 4 to get end of the range
        echo $index + 4 . PHP_EOL;
        exit(0);
    }
}
