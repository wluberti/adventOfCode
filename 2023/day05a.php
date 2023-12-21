<?php

$data = file(__DIR__ . '/day05_input.txt');

$startingSeeds = [];
$almanac = [];

// Build the almanac
foreach ($data as $line) {
    // Populate seeds
    if (str_contains($line, 'seeds: ')) {
        preg_match("/seeds: (.*)/", $line, $seeds);
        $startingSeeds = array_map('intval', explode(' ', $seeds[1]));
        continue;
    }

    // Define map
    if (str_contains($line, 'map:')) {
        preg_match("/(.*) map:/", $line, $mapName);
        $currentMapName = $mapName[1];

        if (count($almanac) > 1) {
            $almanac[count($almanac) - 2]->setNextMapName($almanac[count($almanac) - 1]->getName());
        }

        $almanac[] = new Map($currentMapName);
        continue;
    }

    // Populate the ranges
    if (preg_match_all('/\d+/', $line, $matches)) {
        foreach ($matches as $match) {
            $range = new Range(
                intval($match[0]),
                intval($match[1]),
                intval($match[2]),
            );
            end($almanac)->ranges[] = $range;
        }
    }
}

$minValue = PHP_FLOAT_MAX;
foreach ($startingSeeds as $seed) {
    foreach ($almanac as $currentMap) {
        $seed = $currentMap->getMappedValue($seed);
    }
    $minValue = min($seed, $minValue);
}
echo $minValue ."\n";

class Map {
    public string $nextMapName = '';
    public array $ranges = [];

    public function __construct(
        public string $name
    ) { /* Empty */ }

    public function getMappedValue(int $value): int {
        foreach ($this->ranges as $range) {
            if ($range->sourceStart <= $value && $value <= $range->getSourceEnd()) {
                return $range->getMappedValue($value);
            }
        }

        return $value;
    }

    public function setNextMapName(string $nextMapName): void {
        $this->nextMapName = $nextMapName;
    }

    public function getNextMapName(): string {
        return $this->nextMapName;
    }

    public function getName(): string {
        return $this->name;
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
