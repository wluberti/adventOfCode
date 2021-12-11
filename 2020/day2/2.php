<?php declare(strict_types=1);

$data = file('input.txt');
$result = [];

foreach ($data as $passwordline) {
    preg_match('/(?P<pos1>\d+)-(?P<pos2>\d+) (?P<letter>\w): (?P<password>\w+)/', $passwordline, $linedata);

    $switch = -1;

    if ($linedata['password'][(int)$linedata['pos1'] - 1] == $linedata['letter']) {
        $switch *= -1;
    }

    if ($linedata['password'][(int)$linedata['pos2'] - 1] == $linedata['letter']) {
        $switch *= -1;
    }

    if ($switch > 0) {
        $result[] = $linedata['password'];
    }
}

echo count($result);
