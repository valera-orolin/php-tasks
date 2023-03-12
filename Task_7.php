<?php

/*
    checkURL(string) function checks if input string is a valid url address using regular expressions.
    If it is valid, function returns 'OK' string, otherwise 'Not a valid URL' string.
*/

function checkURL($input) {
    return preg_match("#^https?://.+#", $input) ? 'OK' : 'Not a valid URL';
}


/*
    An example of usage:
*/

$url = 'htps://innowise,com/';
$answer = checkURL($url);
echo "URL: $url</br>Answer: $answer </br>";

$url = 'https://innowise.com/';
$answer = checkURL($url);
echo "URL: $url</br>Answer: $answer </br>";

?>