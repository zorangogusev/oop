<?php

/**
 * Polymorphism is when classes have different functionality while sharing a
 * common interface.
 * In polymorphism the code working with the different classes does not need to
 * know which class it is using since they're all used the same way.
 * The purpose of polymorphism is to simplify the maintaining of the
 * applications, making them more extendable and is an integral part of many
 * design patterns.
 *
 * In the example below the class DemoPolymorphism has different functionality
 * on every different parameter.
 */

interface Draw
{
    public function draw(): void;
}


class TextBox implements Draw
{
    public function draw(): void
    {
        echo 'Drawing a TextBox' . '<br>';
    }
}

class CheckBox implements Draw
{
    public function draw(): void
    {
        echo 'Drawing a CheckBox' . '<br>';
    }
}

class NumberBox implements Draw
{
    public function draw(): void
    {
        echo 'Drawing a Number' . '<br>';
    }
}

class DemoPolymorphism
{
    public function __construct($instanceOfClass)
    {
        $instanceOfClass->draw();
    }
}

$textBox = new DemoPolymorphism(new TextBox());
$checkBox = new DemoPolymorphism(new CheckBox());
$numberBox = new DemoPolymorphism(new NumberBox());
