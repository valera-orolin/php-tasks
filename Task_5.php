<?php

/*
    findNumbersFromAToB(int, int) function returns array that contains all numbers from A to B inclusive, 
    in ascending order if A < B, or in descending order otherwise. Recursion is used.
*/

function findNumbersFromAToB($a, $b) {
    static $numbers = array();
    if ($a < $b) {
        array_push($numbers, $a);
        return findNumbersFromAToB($a + 1, $b);
    } else if ($a > $b) {
        array_push($numbers, $a);
        return findNumbersFromAToB($a - 1, $b);
    } else {
        array_push($numbers, $b);
        $temp = $numbers;
        $numbers = array();
        return $temp;
    }
}


/*
    An example of usage:
*/

echo 'From 4 to 9: ';
echo  var_dump(findNumbersFromAToB(4, 9)) . '</br>';

echo 'From 9 to 4: ';
echo var_dump(findNumbersFromAToB(9, 4)) . '</br>';

echo 'From 9 to 9: ';
echo var_dump(findNumbersFromAToB(9, 9)) . '</br>';

?>