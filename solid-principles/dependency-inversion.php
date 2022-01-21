<?php

/**
 * Entities must depend on abstractions, not on concretions.
 * Entities should not depend on classes but on interfaces.
 *
 * In the example bellow to be able to change the database engine without
 * modifying the class ConnectToDatabase, that class will have to depend on
 * interface and not on instance of a class, to depend on abstraction not on
 * concretion.
 */

interface DatabaseConnectionInterface
{
    public function connect(): void;
}

class MySqlConnection implements DatabaseConnectionInterface
{
    public function connect(): void
    {
        echo 'Connected to MySQL database' . '<br>';
    }
}

class PostgreSQLConnection implements DatabaseConnectionInterface
{
    public function connect(): void
    {
        echo 'Connected to PostgreSQL database' . '<br>';
    }
}

class ConnectToDatabase
{
    public function __construct(private DatabaseConnectionInterface $dbConnection)
    {
        $this->dbConnection->connect();
    }
}

class DemoDependencyInversion
{
    public function __construct()
    {
        echo 'DEPENDENCY INVERSION PRINCIPLE' . '<br/><br/>';
        $mysqlConnection = new ConnectToDatabase(new MySqlConnection());
        $postgreSQLConnection = new ConnectToDatabase(new PostgreSQLConnection());
    }
}

$demoDependencyInversion = new DemoDependencyInversion();
