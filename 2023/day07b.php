<?php

die('not working :-(');

$data = file(__DIR__ . '/day07_testinput.txt');
//$data = file(__DIR__ . '/day07_input.txt');

$rankList = [];
$order = ['A', 'K', 'Q', 'T', '9', '8', '7', '6', '5', '4', '3', '2', 'J'];
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
    public string $originalHand;

    public function __construct(
        public string $hand,
        public int $bid,
    ) {
        $this->originalHand = $hand;
        $this->setType();
    }

    public function getType(): string {
        global $typeList;
        return $typeList[$this->type];
    }

    public function setType(): void {
        global $cardOrder, $rankList;
        $handInfo = array_count_values(str_split($this->hand));
        arsort($handInfo);

        if (array_key_exists('J', $handInfo)) {
            print "=== Hand before tranform : {$this->hand}" . PHP_EOL;
            $transformHandInfo = $handInfo;
            switch (array_shift($transformHandInfo)) {
                case 5: $this->type = 0; break;
                case 4: $this->type = 1; break;
                case 3:
                    if (array_shift($transformHandInfo) === 2) { $this->type = 2; }
                    else { $this->type = 3; }
                    break;
                case 2 :
                    if (array_shift($transformHandInfo) === 2) { $this->type = 4; }
                    else { $this->type = 5; }
                    break;
                case 1 : $this->type = 6; break;
                default:
                    die('should not happen');
            }

            print "=== Hand after tranform : {$this->hand}" . PHP_EOL;

            $numberOfJs = 0;
            $highestCardCount = 0;
            $highestCardName = null;

            // find highest non-J card in sorted 'ar'-sorted $handInfo
            foreach ($handInfo as $card => $amount) {
                $highestCardCount = max($highestCardCount, $amount);

                if ($amount === $highestCardCount) {
                    $highestCardName = $card;
                }

                // Find amount of J's and remove them from handInfo
                if ($card === 'J') {
                    $numberOfJs = $amount;
                    unset($handInfo['J']);
//                    continue;
                }



                print "J's {$numberOfJs} , highest card {$card} count {$highestCardCount}" .PHP_EOL;



            }
        }

//        print_r($handInfo);
        print('-----------------------' . PHP_EOL);

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

    public static function compareLetter(string $letter1, string $letter2): int {
        global $order;
        $indexA = array_search($letter1, $order);
        $indexB = array_search($letter2, $order);

        return $indexB <=> $indexA;
    }
}