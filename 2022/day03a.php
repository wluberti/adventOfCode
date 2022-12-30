<?php

$sourceFile = 'day03_input.txt';
$unique = [];
$values = [];

foreach(file($sourceFile) as $line) {
    list($backpack1, $backpack2) = str_split(trim($line), strlen($line) / 2);
    $unique[] = array_values(array_unique(array_intersect(str_split($backpack2), str_split($backpack1))))[0];
}

foreach($unique as $val) {
    if (ord($val) >= 65 && ord($val) <= 90 ) {
        $values[] = (ord($val) - 38);
    } elseif (ord($val) >= 97 && ord($val) <= 122 ) {
        $values[] = (ord($val) - 96);
    }
}

echo array_sum($values) . PHP_EOL;
