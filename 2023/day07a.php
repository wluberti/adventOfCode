<?php

//$data = file(__DIR__ . '/day07_testinput.txt');
$data = file(__DIR__ . '/day07_input.txt');

$rankList = [];
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

// Read the input file into $rankList
foreach ($data as $line) {
    list($hand, $bid) = explode(' ', trim($line));
    new Hand($hand, $bid);
}

$sortedHands = [];
foreach ($rankList as $ranking => $hands) {
    usort($hands, 'Hand::compareHands');
    $sortedHands[$ranking] = $hands;
}

$total = 0;
$rank = 1;
foreach (range(6, 0) as $index) {
    if (key_exists($index, $sortedHands)) {
        foreach ($sortedHands[$index] as $sortedHand) {
            $total += $sortedHand->bid * $rank;
            $rank++;
        }
    }
}
print $total;

print PHP_EOL;

class Hand {
    public int $type = 6; // Default the lowest ranking according to $typeList

    public function __construct(
        public string $hand,
        public int $bid,
    ) { $this->setType(); }

    public function getType(): string {
        global $typeList;
        return $typeList[$this->type];
    }

    public function setType(): void {
        global $rankList;
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
        $rankList[$this->type][] = $this;
    }

    public static function compareHands(Hand $hand1, Hand $hand2) {
        $hand1 = str_split($hand1->hand);
        $hand2 = str_split($hand2->hand);

        foreach ($hand1 as $index => $_) {
            if (Hand::compareLetter($hand1[$index], $hand2[$index]) === 0) continue;
            return Hand::compareLetter($hand1[$index], $hand2[$index]);
        }
        return 0;
    }

    public static function compareLetter(string $a, string $b): int {
        global $order;
        $indexA = array_search($a, $order);
        $indexB = array_search($b, $order);

        return $indexB <=> $indexA;
    }
}