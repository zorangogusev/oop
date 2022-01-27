<?php

declare(strict_types=1);

/**
 * The problem that Singleton solve is that allows to have one and only one
 * instance of given class in the project.
 * Singleton is 'grand daddy' for all design patterns, it is fancy name/way to
 * say for global variable(it create global state).
 * This pattern involves a single class which is responsible to create an object
 * while making sure that only single object gets created. This class provides a
 * way to access its only object which can be access directly without
 * instantiating the object of the class.
 */

class SingletonObject
{
    private static object $singletonInstance;

    private function __construct()
    {

    }

    protected function __clone()
    {

    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton');
    }

    public static function getInstance(): object
    {
        if(!isset(SingletonObject::$singletonInstance)) {
            SingletonObject::$singletonInstance = new SingletonObject();
        }

        return SingletonObject::$singletonInstance;
    }

    public function showMessage():  void
    {
        echo 'Hello, Singleton Pattern here<br>';
    }
}

class DemoSingletonPattern
{
    public function __construct()
    {
        echo 'SINGLETON DESIGN PATTERN' . '<br/><br/>';

        $singleton1 = SingletonObject::getInstance();
        $singleton1->showMessage();
        echo '<br>';
        $singleton2 = SingletonObject::getInstance();
        $singleton2->showMessage();

        echo '<hr>';

        if($singleton1 === $singleton2) {
            echo 'The instance $singleton1 is the same object as the instance $singleton2';
        } else {
            echo 'The instance $singleton1 is not the same object as the instance $singleton2';
        }
    }
}

$demoSingletonPattern = new DemoSingletonPattern();
