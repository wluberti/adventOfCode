<?php

die('not working :-(');

// my attempt failed. Rewrote based on https://www.youtube.com/watch?v=NmxHw_bHhGM

//$data = file(__DIR__ . '/day05_testinput.txt');
$data = file(__DIR__ . '/day05_input.txt');

/** @var Map[] $almanac */
$almanac = [];
$seeds = [];
// 17729182

// Build the almanac
foreach ($data as $line) {
    // Populate seeds
    if (str_contains($line, 'seeds: ')) {
        preg_match("/seeds: (.*)/", $line, $seedMatches);
        $startingSeeds = array_map('intval', explode(' ', $seedMatches[1]));

        // Convert startingSeeds to startingSeedRanges
        for ($index = 0; $index < count($startingSeeds); $index += 2) {
            $seeds[] = [
                $startingSeeds[$index],                             // Range start (first seed)
                $startingSeeds[$index] + $startingSeeds[$index + 1] // Range end (last seed)
            ];
        }

        continue;
    }

    // Define map
    if (str_contains($line, 'map:')) {
        $almanac[] = new Map();
        continue;
    }

    // Populate the ranges
    if (preg_match_all('/\d+/', $line, $rangeMatches)) {
        foreach ($rangeMatches as $match) {
            end($almanac)->ranges[] = new Range(
                intval($match[0]),
                intval($match[1]),
                intval($match[2]),
            );
        }
    }
}
print_r($almanac);
print_r($seeds);
die();

foreach ($almanac as $map) {
    $new = [];
    while ($seeds) {
        list($start, $end) = array_pop($seeds);
        $store = true; // Hack for Python's for-else
        foreach ($map->ranges as $range) {
            $overlapStart = max($start, $range->sourceStart);
            $overlapEnd = min($end, $range->sourceStart - $range->length);
            if ($overlapStart < $overlapEnd) {
                $new[] = [
                    $overlapStart - $range->sourceStart + $range->destinationStart,
                    $overlapEnd - $range->sourceStart + $range->destinationStart
                ];
                if ($overlapStart > $start) {
                    $seeds[] = [$start, $overlapStart];
                }
                if ($end > $overlapEnd) {
                    $seeds[] = [$overlapEnd, $end];
                }
                $store = false;
                continue;
            }
        }
        if ($store) $new[] = [$start, $end];
        $seeds[] = $new;
    }
}

print_r(min($seeds));

class Map {
    public array $ranges = [];

    public function getMappedValue(int $value): int {
        foreach ($this->ranges as $range) {
            if ($range->sourceStart <= $value && $value <= $range->getSourceEnd()) {
                return $range->getMappedValue($value);
            }
        }

        return $value;
    }
}

class Range {
    public function __construct(
        public int $destinationStart,
        public int $sourceStart,
        public int $length,
    ) { /* Empty */ }

    public function getSourceEnd(): int {
        return $this->sourceStart + $this->length;
    }

    public function getMappedValue($value): int {
        return  $value - $this->sourceStart + $this->destinationStart;
    }
}
