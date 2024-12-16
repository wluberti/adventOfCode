<?php

$data = file_get_contents(__DIR__ . '/day03_input.txt');
$total = 0;

// Filter the input
preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $data, $multiplications );

function processMul(string $mul) {
    preg_match_all('/\d{1,3}/', $mul, $numbers );
    return intval($numbers[0][0]) * intval($numbers[0][1]);
}

foreach ($multiplications[0] as $multiplication) {
    $total += processMul($multiplication);
}

print $total . PHP_EOL;

