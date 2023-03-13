<?php

/*
    The MyCalculator implements the folowing methods:

    add()
    multiply()
    divide()
    subtract()
    addBy()
    divideBy()
    multiplyBy()
    subtractBy()
*/

class MyCalculator {

    private $a;
    private $b;
    private $result;

    function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
        $this->result = 0;
    }

    function __toString(): string {
        $temp = $this->result;
        $this->result = 0;
        return $temp;
    }

    function add() {
        $this->result = $this->a + $this->b;
        return $this;
    }

    function substract() {
        $this->result = $this->a - $this->b;
        return $this;
    }

    function multiply() {
        $this->result = $this->a * $this->b;
        return $this;
    }

    function divide() {
        $this->result = $this->a / $this->b;
        return $this;
    }

    function addBy($number) {
        $this->result += $number;
        return $this;
    }

    function substractBy($number) {
        $this->result -= $number;
        return $this;
    }

    function multiplyBy($number) {
        $this->result *= $number;
        return $this;
    }

    function divideBy($number) {
        $this->result /= $number;
        return $this;
    }
}


/*
    An example of usage:
    12+6=18
    (12+6)/9=2
*/

$calc = new MyCalculator(12, 6);
echo '12 + 6 = ' . $calc->add() . '</br>';
echo '(12 + 6) / 9 = ' . $calc->add()->divideBy(9);

?>
