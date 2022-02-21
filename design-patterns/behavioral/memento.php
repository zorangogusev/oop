<?php

declare(strict_types=1);

/**
 * Memento pattern is used to restore state of an object to a previous state.
 */

class Memento
{
    public function __construct(private string $state) { }

    public function getState(): string
    {
        return $this->state;
    }
}

class Originator
{
    private string $state;

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function saveStateToMemento(): object
    {
        return new Memento($this->state);
    }

    public function getStateFromMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }
}

class CareTaker
{
    private array $mementoList;

    public function add(Memento $object): void
    {
        $this->mementoList[] = $object;
    }

    public function get(int $index): object
    {
        return $this->mementoList[$index];
    }
}

class DemoMementoPattern
{
    public function __construct()
    {
        echo 'MEMENTO DESIGN PATTERN' . '<br/><br/>';

        $originator = new Originator();
        $careTaker = new CareTaker();
        $originator->setState('State #1');
        $originator->setState('State #2');
        $careTaker->add($originator->saveStateToMemento());
        $originator->setState('State #3');
        $careTaker->add($originator->saveStateToMemento());
        $originator->setState('State #4');
        echo 'Current State is: ' . $originator->getState() . '<br/>';
        $originator->getStateFromMemento($careTaker->get(0));
        echo 'First saved State is: ' . $originator->getState() . '<br/>';
        $originator->getStateFromMemento($careTaker->get(1));
        echo 'Second saved State is: ' . $originator->getState();
    }
}

$demoMementoPattern = new DemoMementoPattern();
