<?php

/**
 * Encapsulation is achieved when each object keeps its state private, inside a
 * class. Other objects don’t have direct access to this state. Instead, they
 * can only call a list of public functions — called methods.
 * So, the object manages its own state via methods — and no other class can
 * touch it unless explicitly allowed. If you want to communicate with the
 * object, you should use the methods provided. But (by default), you can’t
 * change the state.
 * With encapsulation the data and the programs that manipulate those data
 * are bound together(and safe from outside interference) and also their
 * complexity is hidden.
 *
 * In the example below, the balance is hidden and other objects can't access it
 * directly. To change the private property balance the other objects need to
 * use the public functions that have access to that property.
 */

class Account
{
    private float $balance = 0;

    public function deposit(float $amount): void
    {
        if($amount > 0) $this->balance += $amount;
    }

    public function withdraw(float $amount): void
    {
        if($amount > 0) $this->balance -= $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}

class DemoEncapsulation
{
    public function __construct()
    {
        $account = new Account();
        $account->deposit(18);
        $account->withdraw(5);
        echo $account->getBalance();
    }
}

$main = new DemoEncapsulation();
