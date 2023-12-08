<?php

$data = file_get_contents('day03_input.txt');

function convertFileToMatrix(string $data): array {
    $data = explode("\n", $data);
    $lines = [];
    foreach ($data as $line) {
        $lines[] = str_split($line, 1);
    }

    return $lines;
}

function createNumberBubble(array $data): array {
    $coordinatesArray = [
        [-1, -1], [-1, 0], [-1, 1],
        [ 0, -1],          [ 0, 1],
        [ 1, -1], [ 1, 0], [ 1, 1],
    ];

    $numbers = [];

    for ($row = 0; $row < count($data); $row++) {
        for ($column = 0; $column < count($data[$row]); $column++) {
            if ($data[$row][$column] === '*') {
                $numberParts = [];
                foreach ($coordinatesArray as $coordinate) {
                    if (isset($data[$row + $coordinate[0]][$column + $coordinate[1]])
                        && is_numeric($data[$row + $coordinate[0]][$column + $coordinate[1]])
                    ) {
                        // Find the start of a number
                        $numberStart = false;
                        for ($i = $column + $coordinate[1]; ; $i--) {
                            if (!isset($data[$row + $coordinate[0]][$i]) || is_numeric($data[$row + $coordinate[0]][$i]) === false) {
                                $numberStart = $i + 1;
                                break;
                            }
                        }

                        // Find the end of a number
                        $numberEnd = false;
                        for ($i = $column + $coordinate[1]; ; $i++) {
                            if (!isset($data[$row + $coordinate[0]][$i]) || is_numeric($data[$row + $coordinate[0]][$i]) === false) {
                                $numberEnd = $i - 1;
                                break;
                            }
                        }

                        // Extract the number.
                        $number = '';
                        if ($numberStart !== false && $numberEnd !== false) {
                            for ($i = $numberStart; $i <= $numberEnd; $i++) {
                                $number .= $data[$row + $coordinate[0]][$i];
                                $data[$row + $coordinate[0]][$i] = '.';
                            }
                        }

                        // Store
                        $numberParts[] = (int) $number;

                        // More than one gear number found, so multiply them together.
                        if (count($numberParts) > 1) {
                            $numbers[] = array_product($numberParts);
                        }
                    }
                }
            }
        }
    }

    return $numbers;
}

$data = convertFileToMatrix($data);
$numbers = createNumberBubble($data);
$total = array_sum($numbers);

echo 'Total: ' . $total . PHP_EOL;