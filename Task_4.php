<?php

/*
    deleteAtPosition(array, int) function deletes the element from the list in the 'n' position. 
    After deleting the element, integer keys are being normalized. Function returns the resulting array.
*/

function deleteAtPosition($arr, $position) {
    for ($i = $position; $i < count($arr) - 1; $i++) {
        $arr[$i] = $arr[$i + 1];
    }
    return array_slice($arr, 0, count($arr) - 1);
}


/*
    An example of usage:
*/

$arr = array(1, 2, 3, 4, 5);
echo var_dump($arr) . '</br>';
echo var_dump(deleteAtPosition($arr, 4));

?>