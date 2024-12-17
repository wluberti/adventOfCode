<?php

//$data = file(__DIR__ . '/day05_input.txt');
$data = file(__DIR__ . '/day05_input_example.txt');
$total = 0;

// Filter the input
foreach ($data as $line) {
    if(strpos($line, '|') !== false) {
        list($before, $after) = explode('|', trim($line));
        $rules[$before][] = $after;
    } elseif (strpos($line, ',') !== false) {
        $sequences[] = explode(',', trim($line));
    }
}

print_r($rules);
//print_r($sequences);

die();

function findRule(int $page): array {
    global $rules;
    foreach ($rules as $rule) {
        if (!array_key_exists($item, $rules)) { continue; }

        $violates[] = $rules[$item];
    }
    return $violates;
}

function checkSequence(array $sequence) {
    global $rules;
    $violates = [];

    // find appropriate rules

    for ($i = 0; $i < count($sequence); $i++) {

    }

}

foreach ($sequences as $order) {
    if (checkSequence($order, $rules)) {
        print_r($order);
        print('-----------------------' . PHP_EOL);
    }
}
