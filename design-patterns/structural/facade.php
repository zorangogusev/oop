<?php

declare(strict_types=1);

/**
 * Facade pattern hides the complexities of the system and provides an interface
 * to the client and with the interface the client can access the system.
 * This pattern adds an interface to existing system to hide its complexities
 * and involves a single class which provides simplified methods required by
 * the client and delegates calls to methods of existing system classes.
 */

interface Shape
{
    public function draw(): void;
}

class Rectangle implements Shape
{

    public function draw(): void
    {
        echo 'Rectangle::draw()' . '<br/>';
    }
}


class Square implements Shape
{

    public function draw(): void
    {
        echo 'Square::draw()' . '<br/>';
    }
}


class Circle implements Shape
{

    public function draw(): void
    {
        echo 'Circle::draw()' . '<br/>';
    }
}

class ShapeMarket
{
    private Circle $circle;
    private Rectangle $rectangle;
    private Square $square;

    public function __construct()
    {
        $this->circle = new Circle();
        $this->rectangle = new Rectangle();
        $this->square = new Square();
    }

    public function drawCircle(): void
    {
        $this->circle->draw();
    }

    public function drawRectangle(): void
    {
        $this->rectangle->draw();
    }

    public function drawSquare(): void
    {
        $this->square->draw();
    }
}

class DemoFacadePattern
{
    public function __construct()
    {
        echo 'FACADE DESIGN PATTERN' . '<br/><br/>';

        $shapeMaker = new ShapeMarket();
        $shapeMaker->drawCircle();
        $shapeMaker->drawRectangle();
        $shapeMaker->drawSquare();
    }
}

$demoFacadePattern = new DemoFacadePattern();
