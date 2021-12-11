<?php

$data = file('input.txt');
$numbers = [];

foreach ($data as $number) {
    $numbers[] = (int)$number;
}

for ($x = 0; $x < count($numbers); $x++) {
    for ($y = 0; $y < count($numbers); $y++) {
        for ($z = 0; $z < count($numbers); $z++) {
            if ((int)$numbers[$x] + (int)$numbers[$y] + (int)$numbers[$z] == 2020) {
                echo sprintf(
                        '%d * %d * %d = %d',
                        $numbers[$x],
                        $numbers[$y],
                        $numbers[$z],
                        $numbers[$x] * $numbers[$y] * $numbers[$z]
                    ) . PHP_EOL;
                die;
            }
        }
    }
}
