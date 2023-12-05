<?php

// Stole from https://github.com/chipotle/Advent_of_Code_2022/blob/main/advent-code-7.php

$data = array_map('trim', file('day07_input.txt'));

foreach ($data as $l) {
    $tok = explode(' ', $l);
    if ($tok[0] == '$') {
        if ($tok[1] == 'cd') {
            $path = match ($tok[2]) {
                '/' => 'root/',
                '..' => (strrpos($path, '/', -1) === false ?
                    'root/' :
                    substr($path, 0, strrpos($path, '/', -1) - 1)
                ),
                default => $path . $tok[2] . '/'
            };
        }
    } else {
        if ($tok[0] !== 'dir') $dirs[$path][$tok[1]] = $tok[0];
    }
}
$totals = [];
foreach ($dirs as $path => $files) {
    $pathwalk = '';
    foreach (explode('/', $path) as $segment) {
        if ($segment == '') continue;
        $pathwalk = $pathwalk . '/' . $segment;
        if (array_key_exists($pathwalk, $totals)) {
            $totals[$pathwalk] += array_sum($files);
        } else {
            $totals[$pathwalk] = array_sum($files);
        }
    }
}
$p1 = 0;
foreach ($totals as $total) {
    if ($total <= 100000) $p1 += $total;
}
echo "Sum of total sizes of directories under 100K: $p1\n";

$p2 = $totals['/root'];
$needed = 30000000 - (70000000 - $p2);
foreach ($totals as $total) {
    if ($total < $p2 && $total >= $needed) $p2 = $total;
}
echo "Size of directory to delete: $p2\n";