<?php

declare(strict_types=1);

/**
 * Interpreter pattern provides a way to evaluate language grammar or
 * expression. This pattern involves implementing an expression interface which
 * tells to interpret a particular context. This pattern is used in SQL parsing,
 * symbol processing engine etc.
 */

interface Expression
{
    public function interpret(string $context): bool;
}

class TerminalExpression implements Expression
{
    public function __construct(private string $data)
    { }

    public function interpret(string $context): bool
    {
        if(str_contains($context, $this->data)) {
            return true;
        }

        return false;
    }
}

class OrExpression implements Expression
{
    public function __construct(
        private Expression $expr1,
        private Expression $expr2)
    { }

    public function interpret(string $context): bool
    {
        return ($this->expr1->interpret($context)
            || $this->expr2->interpret($context));
    }
}

class AndExpression implements Expression
{
    public function __construct(
        private Expression $expr1,
        private Expression $expr2)
    { }

    public function interpret(string $context): bool
    {
        return ($this->expr1->interpret($context)
            AND $this->expr2->interpret($context));
    }
}

class DemoInterpreterPattern
{
    public function __construct()
    {
        echo 'INTERPRETER DESIGN PATTERN' . '<br/><br/>';

        $isMale = self::getMaleExpression();
        $isMarriedWoman = self::getMarriedWomanExpression();

        echo 'John is male name? ' . ($isMale->interpret('John')
                ? 'True' : 'False') . '<br/>';
        echo 'Ana is male name? ' . ($isMale->interpret('Ana')
                ? 'True' : 'False') . '<br/>';
        echo 'Julie is married woman? '
            . ($isMarriedWoman->interpret('Married Julie')
                ? 'True' : 'False');
    }

    public static function getMaleExpression()
    {
        $robert = new TerminalExpression('Robert');
        $john = new TerminalExpression('John');

        return new OrExpression($robert, $john);
    }

    public static function getMarriedWomanExpression()
    {
        $julie = new TerminalExpression('Julie');
        $married = new TerminalExpression('Married');

        return new AndExpression($julie, $married);
    }
}

$demoInterpreterPattern = new DemoInterpreterPattern();
