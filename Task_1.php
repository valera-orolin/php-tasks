<?php

/*
    compareNumberIf(int), compareNumberSwitch(int) and compareNumberTernary(int) functions
    test whether an input number is greater than 30, 20 or 10 and return one of these
    strings: 'more than 30', 'more than 20', 'more than 10' or 'equal or less than 10'.
*/

function compareNumberIf($inputNumber) {
    if ($inputNumber > 30) {
        return 'more than 30';
    }
    if ($inputNumber > 20) {
        return 'more than 20';
    }
    if ($inputNumber > 10) {
        return 'more than 10';
    }
    return 'equal or less than 10';
}

function compareNumberSwitch($inputNumber) {
    switch (true) {
        case $inputNumber > 30:
            return 'more than 30';
            break;
    
        case $inputNumber > 20:
            return 'more than 20';
            break;
    
        case $inputNumber > 10:
            return 'more than 10';
            break;
    }
    return 'equal or less than 10';
}

function compareNumberTernary($inputNumber) {
    return $inputNumber > 30 ? 'more than 30' : 
            ($inputNumber > 20 ? 'more than 20' : 
            ($inputNumber > 10 ? 'more than 10' : 'equal or less than 10'));
}


/*
    An example of usage:
*/

$answer = compareNumberIf(45);
echo "45 is $answer </br>";

$answer = compareNumberIf(17);
echo "17 is $answer </br>";

$answer = compareNumberIf(10);
echo "10 is $answer </br>";

?>

