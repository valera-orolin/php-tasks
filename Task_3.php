<?php

/*
    addDigits(int) function adds the digits by absolute of an integer repeatedly until the 
    result has a single digit and returs this last digit.
*/

function addDigits($number) {
    $arr = str_split((string) $number);
    while (count($arr) != 1) {
        $counter = 0;
        foreach ($arr as $var) {
            $counter += (int) $var;
        }
        $arr = str_split((string) $counter);
    }
    return (int) $arr[0];
}


/*
    An example of usage:

    5689 = 5+6+8+9 = 28 = 2+8 = 10 = 1+0 = 1
    7395 = 7+3+9+5 = 24 = 2+4 = 6
    8589 = 8+5+8+9 = 30 = 3+0 = 3
*/

$answer = addDigits(5689);
echo "5689: $answer</br>";

$answer = addDigits(7395);
echo "7395: $answer</br>";

$answer = addDigits(8589);
echo "8589: $answer</br>";

?>