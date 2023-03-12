<?php

/*
    converString(string) function converts strings separated by any of the '_', '-', ' ' characters 
    to single studly caps case words, removes extra spaces on both sides and returns the resulting string.
*/

function converString($input) {
    $input = trim($input);
    $input = preg_split("/[\s\-_]/", $input);
    foreach ($input as &$word) {
        $word = ucfirst($word);
    }
    return implode($input);
}


/*
    An example of usage:
*/

$string = '             The quick-brown_fox jumps over the_lazy-dog       ';
$newString = converString($string);
echo "Old string: <pre>'$string'</pre>New string: <pre>'$newString'</pre>";

?>