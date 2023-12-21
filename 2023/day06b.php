<?php

//$data = file(__DIR__ . '/day06_testinput.txt');
$data = file(__DIR__ . '/day06_input.txt');

$races = [];
foreach ($data as $line) {
//    preg_match('/(\w+):\s+(\d+)\s+(\d+)\s+(\d+)/', $line, $matches);
    preg_match('/(\w+):\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/', $line, $matches);
    $races[$matches[1]] = (int) implode('', array_slice($matches, 2));
}

$result = 1;
$race = new Race($races['Time'], $races['Distance']);
print $race->calculate() . PHP_EOL;

class Race {
    public function __construct(
        public int $raceTime,
        public int $winningDistance
    ) { /* Empty */ }

    public function calculate(): int {
        $wins = 0;
        for ($time = 1; $time < $this->raceTime; $time++) {
            $currentRace = ($this->raceTime - $time) * $time;

            if ($currentRace > $this->winningDistance) {
                 $wins++;
            }
        }

        return $wins;
    }
}