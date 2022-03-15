<?php

declare(strict_types=1);

/**
 * ORM (Object Relational Mapper) is the layer that sits between your database
 * and your application.
 *
 * The active record pattern is an ORM approach to accessing data in a database.
 * A database table or view is wrapped into a class. Thus, an object instance is
 * tied to a single row in the table.
 * The class carries both data and behavior, this means that the interface of an
 * object includes functions such as insert, update, and delete, plus properties
 * that correspond to the columns in the underlying database table.
 *
 * Currently, it is sometimes considered as an anti-pattern because it violates
 * the Single Responsibility Principle and is not easily testable.
 *
 * Implementation example is Eloquent (used in the Laravel framework)
 */

class Person
{
    /** Database table columns: */
    private string $name;
    private string $address;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function __toString(): string
    {
        return '<br/>User: ' . $this->name . '<br/>Address: ' . $this->address;
    }

    /** Database-related operations: */
    public function store(): void
    {
        echo 'Storing in a database ' . $this . '<br/>';
    }

    public function load(string $name): void
    {
        echo 'Loading data from a database for ' . $name ;
        /** get data for person with the name Eva and address Street Two */
        $this->name = $name;
        $this->address = 'Street Two';
    }
}

class DemoActiveRecord
{
    public function __construct()
    {
        $person = new Person();
        $person->setName('Tom');
        $person->setAddress('Street One');
        $person->store();
        echo '<br/>In database was stored: ' . $person;

        echo '<hr>';

        $person->load( 'Eva');
        echo $person;
    }
}

$demoActiveRecord = new DemoActiveRecord();
