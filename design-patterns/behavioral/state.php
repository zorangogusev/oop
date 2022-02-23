<?php

declare(strict_types=1);

/**
 * In State pattern, a class behavior changes based on its state. We create
 * objects which represent various states and a context object whose behavior
 * varies as its state object changes.
 */

interface State
{
    public function doAction(Context $context): void;
    public function toString(): string;
}

class StartState implements State
{
    public function doAction(Context $context): void
    {
        echo 'Player is in start state' . '<br/>';
        $context->setState($this);
    }

    public function toString(): string
    {
        return 'Start State';
    }
}

class StopState implements State
{
    public function doAction(Context $context): void
    {
        echo 'Player is in stop state' . '<br/>';
        $context->setState($this);
    }

    public function toString(): string
    {
        return 'Stop State';
    }
}

class Context
{
    private State $state;

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function getState(): State
    {
        return $this->state;
    }
}

class DemoStatePattern
{
    public function __construct()
    {
        echo 'STATE DESIGN PATTERN' . '<br/><br/>';

        $context = new Context();

        $startState = new StartState();
        $startState->doAction($context);
        echo $context->getState()->toString() . '<br/>';

        $stopState = new StopState();
        $stopState->doAction($context);
        echo $context->getState()->toString() . '<br/>';
    }
}

$demoStatePattern = new DemoStatePattern();
