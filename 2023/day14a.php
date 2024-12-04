<?php

$data = file(__DIR__ . '/day14_testinput.txt');
//$data = file(__DIR__ . '/day14_input.txt');

$map = [];

// read data into array
foreach ($data as $row => $line) {
    foreach (str_split($line) as $col => $coordinate) {
        $map['row' . $row]['col' . $col] = ($coordinate === '.')? null : $coordinate;
    }
}

print_r($map);