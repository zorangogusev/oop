<?php

declare(strict_types=1);

/**
 * ORM (Object Relational Mapper) is the layer that sits between your database
 * and your application.
 *
 * The Data Mapper is ORM approach that separates the in-memory objects from the
 * database keeping them independent. It is responsible for transferring data
 * between objects and the storage objects have no knowledge of the database
 * schema and even the database itself.
 *
 * It conforms to the Single Responsibility principle and objects are easily
 * testable.
 *
 * Implementation example is Doctrine 2 (used in the Symfony framework).
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
        return 'User: ' . $this->name . '<br>Address: ' . $this->address;
    }
}

class PersonDataMapper
{

    /** Database-related operations: */
    public function store(Person $person): void
    {
        echo 'Storing  in a database<br/>' . $person;
    }

    public function load(string $name): Person
    {
        echo 'Loading data from a database for ' . $name . '<br/>';
        $person = new Person();

        /** get data for person with the name EVA */
        $person->setName($name);
        $person->setAddress('Street Two');

        return $person;
    }
}

class DemoActiveRecord
{
    public function __construct()
    {
        $person = new Person();
        $person->setName('Tom');
        $person->setAddress('Street One');

        echo '<br/>';

        $personDataMapper = new PersonDataMapper();
        $personDataMapper->store($person);

        echo '<br/><br/>';

        $person = $personDataMapper->load( 'Eva');
        echo $person;
    }
}

$demoActiveRecord = new DemoActiveRecord();
