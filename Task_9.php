<?php

/*
    The Student class contains the following variables and methods:

    string firstName
    string lastName
    string group
    float averageMark

    Variables can be accessed with getters, set with setters and constructor.

    getScholarship(): int - returns the scholarship amount. 
    If the average grade of the student is 5, then the amount is 100 USD, otherwise 80 USD.
*/

class Student {

    private $firstName;
    private $lastName;
    private $group;
    private $averageMark;

    public function __construct($firstName = '', $lastName = '', $group = '', $averageMark = .0) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setGroup($group);
        $this->setAverageMark($averageMark);
    }

    private function checkFirstName($firstName) {
        if (is_string($firstName)) {
            return $firstName;
        } else {
            throw new Exception('firstName must be string');
        }
    }

    private function checkLastName($lastName) {
        if (is_string($lastName)) {
            return $lastName;
        } else {
            throw new Exception('lastName must be string');
        }
    }

    private function checkGroup($group) {
        if (is_string($group)) {
            return $group;
        } else {
            throw new Exception('group must be string');
        }
    }

    private function checkAverageMark($averageMark) {
        if (is_float($averageMark) && $averageMark >= 0 && $averageMark <= 5) {
            return $averageMark;
        } else {
            throw new Exception('averageMark must be float and between 0 and 5');
        }
    }

    public function setFirstName($firstName) {
        try {
            $this->firstName = $this->checkFirstName($firstName);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function setLastName($lastName) {
        try {
            $this->lastName = $this->checkLastName($lastName);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function setGroup($group) {
        try {
            $this->group = $this->checkGroup($group);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function setAverageMark($averageMark) {
        try {
            $this->averageMark = $this->checkAverageMark($averageMark);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getAverageMark() {
        return $this->averageMark;
    }

    public function getScholarship() {
        return $this->averageMark == 5.0 ? 100 : 80;
    }
}

/*
    The Aspirant class inherits all the methods of the student class.

    It overrides getScholarship(): int method.
    If the average grade of the aspirant is 5, then the amount is 200 USD, otherwise 180 USD.

    The Aspirant class also has a new field: 
    array researchTitles
    
    And new methods for working with this field:
    addResearchTitle(string)
    getResearchTitles(): array
    deleteResearchTitle(string)
*/

class Aspirant extends Student {

    private $researchTitles = array();

    public function addResearchTitle($title) {
        try {
            if (is_string($title)) {
                array_push($this->researchTitles, $title);
            } else {
                throw new Exception('Research title must be string');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '</br>';
        }
    }

    public function getResearchTitles() {
        return $this->researchTitles;
    }

    public function deleteResearchTitle($title) {
        foreach ($this->researchTitles as $key => $item){
            if ($item == $title){
                unset($this->researchTitles[$key]);
            }
        }
    }

    public function getScholarship() {
        return parent::getAverageMark() == 5.0 ? 200 : 180;
    }
}


/*
    An example of usage:
*/

$st = new Student('Antony', 'Stark', '051007', 5.0);
$asp = new Aspirant('Bruce', 'Banner', '051004', 5.0);
$st2 = new Student('Peter', 'Parker', '051001', 4.8);
$school = array($st, $asp, $st2, new Student('Stephen', 'Strange', '051001', 5.0));

foreach ($school as $var) {
    echo $var->getLastName() . ' has average mark ' . $var->getAverageMark() . ' and gets ' . $var->getScholarship() . " USD</br>";
}

$asp->addResearchTitle('Catalysis and synthesis');
$asp->addResearchTitle('Energy, environmental and sustainable chemistry');
$asp->addResearchTitle('Functional materials');
$asp->addResearchTitle('Structural chemistry and chemical dynamics');
$asp->deleteResearchTitle('Functional materials');
echo '</br> Aspirant banner has the following research:</br>';
foreach ($asp->getResearchTitles() as $title) {
    echo "$title</br>";
}

?>