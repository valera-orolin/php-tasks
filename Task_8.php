<?php

/*
    The Matrix class contains the following variables and methods:
    
    values - a two-dimensional array that contains the values of a matrix. 
    setValues(array(array(float...)...)) - sets values, automatically sets rows and columns.
    getValues: (array(array(float...)...)) - returns values.

    rows - number of the rows.
    getRows(): int - returns rows.

    columns - number of the columns.
    getColumns(): int - returns columns.

    addMatrix(Matrix) - adds matrix from the argument to this Matrix.

    multiplyByMatrix(Matrix) - multiplies this Matrix by a matrix from the argument.

    multiplyByNumber(float) - multiplies this Matrix by a number from the argument.

    print() - prints this Matrix.
*/

class Matrix {

    private $values = array();
    private $rows = 0;
    private $columns = 0;

    private function checkMatrix($matrix) {
        if (is_array($matrix) || count($matrix) < 0) {
            $rowLen = count($matrix[0]);
            foreach ($matrix as $row) {
                if (!is_array($row)) {
                    throw new Exception('Each row of the matrix must be an array');
                    return;
                }
                if (count($row) != $rowLen) {
                    throw new Exception('All rows of the matrix must be the same size');
                    return;
                }
                foreach ($row as $value) {
                    if (!is_float($value)) {
                        throw new Exception('Each value of the row of the matrix must be float');
                        return;
                    }
                }
            }
            return $matrix;
        } else {
            throw new Exception('Matrix must be a non empty array');
        }
    }

    public function setValues($values) {
        try {
            $this->values = $this->checkMatrix($values);
            $this->rows = count($values);
            $this->columns = count($values[0]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function getValues() {
        return $this->values;
    }

    public function getRows() {
        return $this->rows;
    }

    public function getColumns() {
        return $this->columns;
    }

    private function isGoodForAdding($matrixB) {
        try {
            if ($this->values == NULL) {
                throw new Exception('Original matrix was not initialised');
            }
            if (!$matrixB instanceof Matrix) {
                throw new Exception('Variable matrixB must be a matrix');
            }
            if ($matrixB->getRows() != $this->rows) {
                throw new Exception('The number of rows of the first matrix must be equal to the number of rows of the second matrix');
            }
            if ($matrixB->getColumns() != $this->columns) {
                throw new Exception('The number of columns of the first matrix must be equal to the number of columns of the second matrix');
            }
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
            return false;
        }
    }

    public function addMatrix($matrixB) {
        if ($this->isGoodForAdding($matrixB)) {
            $valuesMatrixB = $matrixB->getValues();
            for ($i = 0; $i < $this->rows; $i++) {
                for ($j = 0; $j < $this->columns; $j++) {
                    $this->values[$i][$j] += $valuesMatrixB[$i][$j];
                }
            }
        } else {
            echo "wrong";
        }
    }

    private function isGoodForPrinting() {
        try {
            if ($this->values == NULL) {
                throw new Exception('Original matrix was not initialised');
            }
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
            return false;
        }
    }

    public function print() {
        if ($this->isGoodForPrinting()) {
            echo "<pre>";
            foreach ($this->values as $row) {
                foreach ($row as $value) {
                    echo "$value &#9;";
                }
                echo "<br/>";
            }
            echo "</pre>";
        }
    }

    private function findSumOfProducts($matrixA, $matrixB, $n, $m) {
        $counter = $matrixA->getValues()[$n][0] * $matrixB->getValues()[0][$m];
        for ($i = 1; $i < $matrixA->getColumns(); $i++) {
            $counter += $matrixA->getValues()[$n][$i] * $matrixB->getValues()[$i][$m];
        }
        return $counter;
    }

    private function isGoodForMultiplyingByMatrix($matrixB) {
        try {
            if ($this->values == NULL) {
                throw new Exception('Original matrix was not initialised');
            }
            if (!$matrixB instanceof Matrix) {
                throw new Exception('Variable matrixB must be a matrix');
            }
            if ($this->columns != $matrixB->getRows()) {
                throw new Exception('The number of columns of the first matrix must be equal to the number of rows of the second matrix');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function multiplyByMatrix($matrixB) {
        if ($this->isGoodForMultiplyingByMatrix($matrixB)) {
            $matrixA = $this;
            $matrixC = array();
            for ($i = 0; $i < $matrixA->getRows(); $i++) {
                $temp = array();
                for ($j = 0; $j < $matrixB->getColumns(); $j++) {
                    array_push($temp, $this->findSumOfProducts($matrixA, $matrixB, $i, $j));
                }
                array_push($matrixC, $temp);
            }
            $this->setValues($matrixC);
        }
    }

    private function isGoodForMultiplyingByNumber($number) {
        try {
            if ($this->values == NULL) {
                throw new Exception('Original matrix was not initialised');
            }
            if (!is_float($number)) {
                throw new Exception('the number by which the matrix is multiplied must be float');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function multiplyByNumber($number) {
        if ($this->isGoodForMultiplyingByNumber($number)) {
            foreach ($this->values as &$value) {
                $value *= $number;
            }
        }
    }
}


/*
    An example of usage:
*/

$mtx1 = new Matrix();
$mtx1->setValues(array(array(1.0, 2.0), array(3.0, 4.0)));
$mtx2 = new Matrix();
$mtx2->setValues(array(array(5.0, 6.0), array(7.0, 8.0)));
$mtx1->print();
echo '+';
$mtx2->print();
$mtx1->addMatrix($mtx2);
echo '=';
$mtx1->print();

$mtx1->setValues(array(array(1.0, 2.0), array(4.0, 5.0), array(0.0, 0.0)));
$mtx2->setValues(array(array(1.0, 2.0, 3.0, 6.0), array(4.0, 5.0, 6.0, 8.0)));
echo '///////////////';
$mtx1->print();
echo '*';
$mtx2->print();
$mtx1->multiplyByMatrix($mtx2);
echo '=';
$mtx1->print();

$number = 2.5;
echo '///////////////';
$mtx1->print();
echo "* $number =";
$mtx1->multiplyByNumber($number);
$mtx1->print();

?>