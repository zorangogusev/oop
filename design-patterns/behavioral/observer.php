<?php

declare(strict_types=1);

/**
 * Observer pattern is used when there is one-to-many relationship between
 * objects such as if one object is modified, its dependent objects are to be
 * notified automatically.
 * It allow different object not knowing anything about each other(they are
 * individual isolated objects) to be updated at same time when same event
 * happens.
 */

abstract class Observer
{
    protected Subject $subject;
    public abstract function update(): void;
}

class BinaryObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update(): void
    {
        echo 'Binary String: ' . decbin($this->subject->getState()) . '<br/>';
    }
}

class OctalObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update(): void
    {
        echo 'Octal String: ' . decoct($this->subject->getState()) . '<br/>';
    }
}

class HexObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update(): void
    {
        echo 'Hex String: ' . dechex($this->subject->getState()) . '<br/>';
    }
}

class Subject
{
    private array $observers;
    private int $state;

    public function getState(): int
    {
        return $this->state;
    }

    public function setState(int $state): void
    {
        $this->state = $state;
        $this->notifyAllObservers();
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function deattach(Observer $observer): void
    {
        foreach($this->observers as $key => $obs) {
            if($obs == $observer) unset($this->observers[$key]);
        }
    }

    private function notifyAllObservers(): void
    {
        foreach($this->observers as $observer) {
            $observer->update();
        }
    }
}

class DemoObserverPattern
{
    public function __construct()
    {
        echo 'OBSERVER DESIGN PATTERN' . '<br/><br/>';

        $subject = new Subject();
        $hexObserver = new HexObserver($subject);
        $octalObserver = new OctalObserver($subject);
        $binaryObserver = new BinaryObserver($subject);

        echo '<b>First state change: 15</b>' . '<br/>';
        $subject->setState(15);

        echo '<br/>';

        echo '<b>Second state change: 10</b>' . '<br/>';
        $subject->setState(10);

        echo '<br/>';

        $subject->deattach($hexObserver);
        echo '<b>Third State change: 5</b>' . '<br/>';
        $subject->setState(5);
    }
}

$demoObserverPattern = new DemoObserverPattern();
