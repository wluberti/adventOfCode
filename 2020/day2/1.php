<?php declare(strict_types=1);

$data = file('input.txt');
$result = [];

foreach ($data as $passwordline) {
    preg_match('/(?P<min>\d+)-(?P<max>\d+) (?P<letter>\w): (?P<password>\w+)/', $passwordline, $linedata);

    $count = substr_count($linedata['password'], $linedata['letter']);
    if ($count >= (int)$linedata['min'] && $count <= (int)$linedata['max']) {
        $result[] = $linedata;
    }
}

echo count($result);
