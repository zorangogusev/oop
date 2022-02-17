<?php

declare(strict_types=1);

/**
 * Mediator pattern is used to reduce communication complexity between multiple
 * objects or classes. This pattern provides a mediator class which normally
 * handles all the communications between different classes and supports easy
 * maintenance of the code by loose coupling.
 */

class ChatRoom
{
    public static function showMessage(User $user, string $message): void
    {
        echo date('m/d/Y h:i:s a', time()) . ' [' . $user->getName() .
            '] ' . $message . '<br/>';
    }
}

class User
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function sendMessage(string $message): void
    {
        ChatRoom::showMessage($this, $message);
    }
}

class DemoMediatorPattern
{
    public function __construct()
    {
        echo 'MEDIATOR DESIGN PATTERN' . '<br/><br/>';

        $robert = new User();
        $robert->setName('Robert');

        $john = new User();
        $john->setName('John');

        $robert->sendMessage('Hi!, John!');
        $john->sendMessage('Hello! Robert!');
    }
}

$demoMediatorPattern = new DemoMediatorPattern();
