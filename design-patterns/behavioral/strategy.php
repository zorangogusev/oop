<?php

declare(strict_types=1);

/**
 * In Strategy pattern, a class behavior or its algorithm can be changed at run
 * time. We create objects which represent various strategies and a context
 * object whose behavior varies as per its strategy object. The strategy object
 * changes the executing algorithm of the context object.
 */

interface Strategy
{
    public function doOperation(int $num, int $num2): int;
}

class OperationAdd implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 + $num2;
    }
}

class OperationSubtract implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 - $num2;
    }
}

class OperationMultiply implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 * $num2;
    }
}

class Context
{
    public function __construct(private Strategy $strategy)
    { }

    public function executeStrategy(int $num1, int $num2): int
    {
        return $this->strategy->doOperation($num1, $num2);
    }
}

class DemoStrategyPattern
{
    public function __construct()
    {
        echo 'STRATEGY DESIGN PATTERN' . '<br/><br/>';

        $context = new Context(new OperationAdd);
        echo '10 + 5 = ' . $context->executeStrategy(10, 5);

        echo '<br/>';

        $context = new Context(new OperationSubtract());
        echo '10 - 5 = ' . $context->executeStrategy(10, 5);

        echo '<br/>';

        $context = new Context(new OperationMultiply());
        echo '10 * 5 = ' . $context->executeStrategy(10, 5);
    }
}

$demoStrategyPattern = new DemoStrategyPattern();
