<?php

$paradox = [[], [], [], [], [], []];

for ($p1 = 1; $p1 < 64; $p1 += 2) {
    $paradox[0][] = $p1;
}

for ($p2 = 2; $p2 < 64;) {
    $paradox[1][] = $p2;
    $p2 += $p2 % 2 == 0 ? 1 : 3;
}

for ($p3 = 4, $p3s = 1; $p3 < 64; $p3s++) {
    $paradox[2][] = $p3;
    $p3 += $p3s % 4 == 0 && $p3s != 0 ? 5 : 1;
}

for ($p4 = 8, $p4s = 1; $p4 < 64; $p4s++) {
    $paradox[3][] = $p4;
    $p4 += $p4s % 8 == 0 && $p4s != 0 ? 9 : 1;
}

for ($p5 = 16, $p5s = 1; $p5 < 64; $p5s++) {
    $paradox[4][] = $p5;
    $p5 += $p5s % 16 == 0 && $p5s != 0 ? 17 : 1;
}

for ($p6 = 32; $p6 < 64; $p6++) {
    $paradox[5][] = $p6;
}

$step = $result = 0;

do {
    $deck = "";
    foreach ($paradox[$step] as $p) {
        $deck .= $p."\t";
    }

    echo $deck."\n";

    echo "Pick a number between 1-63. Can you spot it on the deck above? [yna]:";

    $handle = fopen ("php://stdin","r");
    $line   = fgets($handle);

    switch (trim($line,"\n\r")) {
        case 'y'  : $result += $paradox[$step][0]; $step++; break;
        case 'n'   : $step++; break;
        case 'a': $result = 0; $step = 0; break;
        default: echo "I said 'y', 'n' or 'a'...\n"; exit;
    }

} while ($step < 6);

if($step === 6) {
    echo ($result === 0) ? "It was not between 1-63. Is it?\n" : "It was ".$result." isn't it?\n";
    fclose($handle);
}
