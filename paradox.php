<?php

$paradox   = [];
$loop      = true;
$next      = false;
$groupSize = 1;
$maxSize   = 2048;
$logSum    = floor(log($maxSize) / log(2));

$step = $result = 0;

while ($loop) {
    $paradox[$step] = [];
    $deck = '';

    for ($i = $groupSize; $i <= $maxSize; $i++) {
        if ($i % $groupSize === 0) {
            $next = !$next;
        }

        if ($next) {
            $paradox[$step][] = $i;
            $deck .= $i."\t";
        }
    }

    echo ($step < $logSum) ? $deck . "\n" . "Pick a number between 1-2048. Can you spot it on the deck above? [yna]:" : "";

    if($step == $logSum) {

        echo ($result > 0)
            ? "\nIt was $result isn't it? \nType 'a' if you want to retry:\n"
            : "\nIt was not between 1-2048. Is it? \nType 'a' if you want to retry:\n";
    }

    $handle = fopen("php://stdin", "r");
    $line   = fgets($handle);

    switch (trim($line, "\n\r")) {
        case 'y':
            $result += $paradox[$step][0];
            $step++;
            $groupSize *= 2;
            break;
        case 'n':
            $step++;
            $groupSize *= 2;
            break;
        case 'a':
            $result = $step = 0; $groupSize = 1;
            break;
        default:
            echo "I said 'y', 'n' or 'a'...\n";
            fclose($handle);
            exit;
    }

    $next = false;
}
