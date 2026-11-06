<?php
// Lineair zoeken
function linearSearch($array, $target) {
    foreach ($array as $element) {
        if ($element == $target) {
            return true;
        }
    }
    return false;
}

// Binair zoeken (recursief, zoals in de pseudocode)
function binarySearch($array, $target, $low, $high) {
    if ($low > $high) {
        return false;
    }
    $mid = (int) floor(($low + $high) / 2);

    if ($array[$mid] == $target) {
        return true;
    } elseif ($array[$mid] > $target) {
        return binarySearch($array, $target, $low, $mid - 1);
    } else {
        return binarySearch($array, $target, $mid + 1, $high);
    }
}

// Test: array met 10000 random getallen
$amount = 10000;
$array = [];
for ($i = 0; $i < $amount; $i++) {
    $array[] = rand(1, 100000);
}

// Sorteren van laag naar hoog
sort($array);

// Target: het laatste getal (slechtste geval voor lineair zoeken)
$target = $array[count($array) - 1];
$repeat = 1000;

// Timen van lineair zoeken
$start = microtime(true);
for ($i = 0; $i < $repeat; $i++) {
    $found = linearSearch($array, $target);
}
$timeLinear = microtime(true) - $start;

// Timen van binair zoeken
$start = microtime(true);
for ($i = 0; $i < $repeat; $i++) {
    $found = binarySearch($array, $target, 0, count($array) - 1);
}
$timeBinary = microtime(true) - $start;

echo "Array met $amount getallen, target = $target, $repeat keer uitgevoerd\n";
echo "Lineair zoeken: " . number_format($timeLinear, 6) . " seconden\n";
echo "Binair zoeken:  " . number_format($timeBinary, 6) . " seconden\n";
echo "Binair is ongeveer " . round($timeLinear / $timeBinary) . " keer sneller\n";