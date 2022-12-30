<?php

$sourceFile = 'day03_input.txt';
$data = [];
$unique = [];

foreach(file($sourceFile) as $line) {
    $data[] = trim($line);
//    $unique[] = array_values(array_unique(array_intersect(str_split($backpack2), str_split($backpack1))))[0];
}

function giveThree() {
    global $data;
    for ($i = 0; $i < count($data); $i+=3) {
        yield [$data[$i], $data[$i+1], $data[$i+2]];
    }
}

foreach (giveThree() as $item) {
    $unique[] = array_values(array_unique(array_intersect(str_split($item[0]), str_split($item[1]), str_split($item[2]))))[0];
}

//var_dump($unique);

//exit();
foreach($unique as $val) {
    if (ord($val) >= 65 && ord($val) <= 90 ) {
        $values[] = (ord($val) - 38);
    } elseif (ord($val) >= 97 && ord($val) <= 122 ) {
        $values[] = (ord($val) - 96);
    }
}

echo array_sum($values) . PHP_EOL;
