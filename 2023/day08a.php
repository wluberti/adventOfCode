<?php

//$data = file(__DIR__ . '/day08_testinput.txt');
$data = file(__DIR__ . '/day08_input.txt');

$nodes = [];
$directions = [];
$navigator = yieldDirections();
$stepCounter = 0;

// read data into array
foreach ($data as $line) {
    if (str_contains($line, '=')) {
        preg_match('/(\w+) = \((\w+), (\w+)\)/', $line, $segments);
        $nodes[$segments[1]] = [$segments[2], $segments[3]];
    } elseif (trim($line) !== '') {
        $directions = str_split(trim($line));
    }
}

function yieldDirections():Iterator {
    global $directions;
    $count = count($directions);
    $index = 0;

    while(true) {
        yield $directions[$index];
        $index = ($index + 1) % $count;
    }
}

function move(string $toNode) {
    global $stepCounter, $nodes, $navigator;

    if ($toNode === 'ZZZ')  die("Number of steps: {$stepCounter}" . PHP_EOL);
    $stepCounter++;

    if ($navigator->current() === 'L') {
        $navigator->next();
        move($nodes[$toNode][0]);
    } else {
        $navigator->next();
        move($nodes[$toNode][1]);
    }
}

move('AAA');