<?php

$data = file(__DIR__ . '/day05_input.txt');

$startingSeeds = [];
$almanac = [];
$section = '';

// Build the almanac
foreach ($data as $line) {
    // Populate seeds
    preg_match("/^(?'verb'[a-zA-Z-]+).*:.?(?'seeds'.*)/", $line, $verbs);
    if(!empty($verbs['seeds'])) {
        $startingSeeds = array_map('intval', explode(' ', $verbs['seeds']));
        continue;
    }

    // Define section
    if(!empty($verbs['verb'])) {
        $section = $verbs['verb'];
        continue;
    }

    // Populate the rest of the almanac
    preg_match_all('/\d+/', $line, $matches);
    foreach ($matches as $match) {
        if(empty($match)) continue;

        $almanac[$section][] = [
            'destination' => (int) $match[0],
            'source' => (int) $match[1],
            'length' => (int) $match[2] -1,
        ];
    }
}


function findNextSectionName(string $section): string {
    global $almanac;
    list ($source, $destination) = explode('-to-', $section);
    foreach (array_keys($almanac) as $sectionName) {
        if (preg_match("/^$destination/", $sectionName)) {
            return $sectionName;
        }
    }
}

function findDestinationSeed(int $seed, array $ranges): int {
    if ($seed >= (int) $ranges['source']
        && $seed <= (int) $ranges['source'] + (int) $ranges['length']
    ) {
        $offset = $seed - (int) $ranges['source'];
        return $offset + (int) $ranges['destination'];
    } else {
        return $seed;
    }
}

function almanacWalk(array $seeds, string $section, $nextSeeds = []) {
    global $almanac;

    foreach ($seeds as $seed) {
        foreach ($almanac[$section] as $ranges) {
            $nextSeeds[] = findDestinationSeed($seed, $ranges);
        }

    }
    $nextSeeds = array_unique($nextSeeds);

    if ($section === 'humidity-to-location') {
        return array_values($nextSeeds);
    }

    return almanacWalk($nextSeeds, findNextSectionName($section));
}

$locations = [];
$locations[] = almanacWalk($startingSeeds, 'seed-to-soil');

print_r($almanac);

print PHP_EOL . 'EOF' . PHP_EOL;


// 382895070