<?php

declare(strict_types=1);

/**
 * In Visitor pattern, we use a visitor class which changes the executing
 * algorithm of an element class. By this way, execution algorithm of element
 * can vary as and when visitor varies. As per the pattern, element object has
 * to accept the visitor object so that visitor object handles the operation on
 * the element object.
 */

interface ComputerPart
{
    public function accept(ComputerPartVisitor $computerPartVisitor): void;
    public function message(): void;
}

interface ComputerPartVisitor
{
    public function visit($part): void;
}


class Keyboard implements ComputerPart
{

    public function accept(ComputerPartVisitor $computerPartVisitor): void
    {
        $computerPartVisitor->visit($this);
    }

    public function message(): void
    {
        echo 'Displaying Keyboard' . '<br/>';
    }
}

class Monitor implements ComputerPart
{

    public function accept(ComputerPartVisitor $computerPartVisitor): void
    {
        $computerPartVisitor->visit($this);
    }

    public function message(): void
    {
        echo 'Displaying Monitor' . '<br/>';
    }
}

class Mouse implements ComputerPart
{

    public function accept(ComputerPartVisitor $computerPartVisitor): void
    {
        $computerPartVisitor->visit($this);
    }

    public function message(): void
    {
        echo 'Displaying Mouse' . '<br/>';
    }
}

class Computer implements ComputerPart
{
    public array $parts;

    public function __construct()
    {
        $this->parts[] = new Mouse();
        $this->parts[] = new Keyboard();
        $this->parts[] = new Monitor();
    }

    public function accept(ComputerPartVisitor $computerPartVisitor): void
    {
        for($i = 0; $i < count($this->parts); $i++) {
            $this->parts[$i]->accept($computerPartVisitor);
        }

        $computerPartVisitor->visit($this);
    }

    public function message(): void
    {
        echo 'Displaying Computer' . '<br/>';
    }
}

class ComputerPartDisplayVisitor implements ComputerPartVisitor
{

    public function visit($part): void
    {
        $part->message();
    }
}

class DemoVisitorPattern
{
    public function __construct()
    {
        echo 'VISITOR DESIGN PATTERN' . '<br/><br/>';

        $computer = new Computer();
        $computer->accept(new ComputerPartDisplayVisitor());
    }
}

$demoVisitorPattern = new DemoVisitorPattern();
