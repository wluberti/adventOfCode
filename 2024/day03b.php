<?php

$data = file_get_contents(__DIR__ . '/day03_input.txt');
$total = 0;

// Filter the input
preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $data, $multiplications, PREG_OFFSET_CAPTURE );
preg_match_all('/do\(\)/', $data, $dos, PREG_OFFSET_CAPTURE );
preg_match_all('/don\'t\(\)/', $data, $donts, PREG_OFFSET_CAPTURE );

//print_r($multiplications[0]);
//print_r($dos[0]);
//print_r($donts[0]);

function processMul(string $mul) {
    preg_match_all('/\d{1,3}/', $mul, $numbers );
    return intval($numbers[0][0]) * intval($numbers[0][1]);
}

function getExludedRanges(array $dos, array $donts) {
    $merged = array_merge($dos[0], $donts[0]);
    usort($merged, function ($a, $b) {
        return $a[1] - $b[1];
    });

    $lastState = '';
    $lastValue = 0;
    $exclude = [];
    foreach ($merged as $item) {
        if ($item[0] !== $lastState) {
            if ($lastState === 'don\'t()') {
                $exclude = array_merge($exclude, range($lastValue, $item[1]));
            }
            $lastState = $item[0];
            $lastValue = $item[1];
        }
    }

    return $exclude;
}

foreach ($multiplications[0] as $multiplication) {
    if (!in_array($multiplication[1], getExludedRanges($dos, $donts))) {
        $total += processMul($multiplication[0]);
    }
}

print $total . PHP_EOL;

