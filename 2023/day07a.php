<?php

$data = file(__DIR__ . '/day07_testinput.txt');
//$data = file(__DIR__ . '/day07_input.txt');

$rankList = [];
$cards = [];
$order = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];
$typeList = [
    0 => 'Five of a kind',
    1 => 'Four of a kind',
    2 => 'Full house',
    3 => 'Three of a kind',
    4 => 'Two pair',
    5 => 'One pair',
    6 => 'High card',
];

// Read the input file
foreach ($data as $line) {
    list($hand, $bid) = explode(' ', trim($line));
    $cards[] = new Hand($hand, $bid);
}


foreach ($cards as $card) {
//    print $card->hand . " - " . $card->getType() . PHP_EOL;
}

print_r($rankList);
print PHP_EOL;

class Hand {
    public int $type = 6;
    public int $rank = 0;

    public function __construct(
        public string $hand,
        public int $bid,
    ) { $this->setType(); }

    public function getType(): string {
        global $typeList;
        return $typeList[$this->type];
    }

    public function setType(): void {
        $handInfo = array_count_values(str_split($this->hand));
        arsort($handInfo);

        switch (array_shift($handInfo)) {
            case 5: $this->type = 0; break;
            case 4: $this->type = 1; break;
            case 3:
                if (array_shift($handInfo) === 2) { $this->type = 2; }
                else { $this->type = 3; }
                break;
            case 2 :
                if (array_shift($handInfo) === 2) { $this->type = 4; }
                else { $this->type = 5; }
                break;
            case 1 : $this->type = 6; break;
            default:
                die('should not happen');
        }

        global $rankList;
        $rankList[$this->type][] = $this;
    }

    public function compareHands(Hand $otherHand) {
        $thisHand = str_split($this->hand);
        $otherHand = str_split($otherHand->hand);

        foreach ($thisHand as $index => $_) {
            print "hand 1: {$thisHand[$index]} hand 2: {$otherHand[$index]} : Result: "
                . $this->compareLetter($thisHand[$index], $otherHand[$index]) . PHP_EOL;
        }
    }

    // $result will be positive if $a is higher value than $b according to $order, negative is less or 0 when equal
    function compareLetter(string $a, string $b): int {
        global $order;
        $indexA = array_search($a, $order);
        $indexB = array_search($b, $order);

        return $indexB - $indexA;
    }

    public function setRank(int $rank): void {
        $this->rank = $rank;
    }
}