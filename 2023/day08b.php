<?php

//$data = file(__DIR__ . '/day08b_testinput.txt');
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

function getNextDestination($currentNode) {
    global $navigator, $nodes;

    if ($navigator->current() === 'L') {
        $leftOrRight = 0;
    } else {
        $leftOrRight = 1;
    }

    return $nodes[$currentNode][$leftOrRight];
}

function move(array $checkNodes) {
    global $stepCounter, $navigator;
    $endNodeCount = [];
    $currentNodesToCheck = [];

    // Check if all end with 'Z'
    foreach ($checkNodes as $node) {
        if (str_ends_with($node, 'Z')) $endNodeCount[] = $node;
        if (count($checkNodes) === count($endNodeCount)) die("Number of steps: {$stepCounter}" . PHP_EOL);
        $currentNodesToCheck[] = getNextDestination($node);
    }

    $navigator->next();
    $stepCounter++;
    move($currentNodesToCheck);
}

// Find first starting nodes
$start = [];
foreach ($nodes as $node => $values) {
    if (str_ends_with($node, 'A')) {
        $start[] = $node;
    }
}

move($start);
