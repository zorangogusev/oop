<?php

declare(strict_types=1);

/**
 * Composite pattern is used where we need to treat a group of objects in
 * similar way as a single object. This pattern composes objects in term of a
 * tree structure to represent part as well the whole hierarchy.
 *
 * Composite pattern creates a class that contains a group of objects. This
 * class provides ways to modify its group of same objects.
 */

class Employee
{
    private array $subordinates = [];

    public function __construct(
        public string $name,
        public string $dept,
        public int $salary
    ) { }

    public function add(Employee $e): void
    {
        $this->subordinates[] = $e;
    }

    public function remove(Employee $e): void
    {
        if(($key = array_search($e, $this->subordinates, TRUE)) !== FALSE){
            unset($this->subordinates[$key]);
        }

    }

    public function getSubordinates(): array
    {
        return $this->subordinates;
    }

    public function getEmployeeData(): string
    {
        return 'Employee: Name: ' . $this->name . ', dept: ' . $this->dept
            . ', salary: ' . $this->salary;
    }

    public function __toString(): string
    {
        return 'Employee :[ Name: ' . $this->name . ', dept: ' . $this->dept
            . ', salary: ' . $this->salary . ' ]' . '<br/>';
    }
}

class DemoCompositePattern
{
    public function __construct()
    {
        echo 'COMPOSITE DESIGN PATTERN' . '<br/><br/>';

        $ceo = new Employee('John', 'CEO', 30000);
        $headSales = new Employee('Robert', 'Head Sales', 20000);
        $headMarketing = new Employee('Michel', 'Head Marketing', 20000);
        $clerk1 = new Employee('Laura', 'Marketing', 10000);
        $clerk2 = new Employee('Bob', 'Marketing', 10000);
        $salesExecutive1 = new Employee('Richard', 'Sales', 5000);
        $salesExecutive2 = new Employee('Rob', 'Sales', 5000);

        $ceo->add($headSales);
        $ceo->add($headMarketing);

        $headSales->add($salesExecutive1);
        $headSales->add($salesExecutive2);

        $headMarketing->add($clerk1);
        $headMarketing->add($clerk2);

        echo '<h1>' . $ceo . '</h1>';
        foreach($ceo->getSubordinates() as $headSubordinate) {
            echo '<h3>' . $headSubordinate . '</h3>';
            foreach($headSubordinate->getSubordinates() as $employee) {
                echo $employee;
            }
        }
    }
}

$demoCompositePattern = new DemoCompositePattern();
