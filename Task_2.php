<?php

/*
    findDaysTillBirthday(string) function returns the number of days left until the person’s next birthday.
    Acceptable date format is 'DD-MM-YYYY'.
*/

function findDaysTillBirthday($bdDate) {

    $date1 = time();
    $date2 = strtotime($bdDate);
    
    $currYear = date('Y', $date1);
    $bdYear = date('Y', $date2);
    $yearDiffrence = $currYear - $bdYear;

    $date2 = strtotime("+$yearDiffrence year", $date2);
    if ($date2 < $date1) {
        $date2 = strtotime("+1 year", $date2);
    }

    $secondsLeft = $date2 - $date1;

    return floor($secondsLeft / (60 * 60 * 24));
}


/*
    An example of usage:
*/

$answer = findDaysTillBirthday('10-04-2000');
echo "$answer days left until the birthday of a person who was born on 10-04-2000</br>";

$answer = findDaysTillBirthday('10-03-2000');
echo "$answer days left until the birthday of a person who was born on 10-03-2000</br>";

?>