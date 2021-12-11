<?php

$data = file('input.txt');
$numbers = [];

foreach ($data as $number) {
    $numbers[] = (int)$number;
}

for ($x = 0; $x < count($numbers); $x++) {
    for ($y = 0; $y < count($numbers); $y++) {
        if ((int)$numbers[$x] + (int)$numbers[$y] == 2020) {
            echo sprintf(
                    '%d * %d = %d',
                    $numbers[$x],
                    $numbers[$y],
                    $numbers[$x] * $numbers[$y]
                ) . PHP_EOL;
            die;
        }
    }
}
