<?php

declare(strict_types=1);

/**
 * Flyweight pattern is primarily used to reduce the number of objects created
 * and to decrease memory footprint and increase performance. This pattern
 * provides ways to decrease object count thus improving the object structure of
 * application.
 * Flyweight pattern tries to reuse already existing similar kind objects by
 * storing them and creates new object when no matching object is found.
 */

interface Shape
{
    public function draw(): void;
}

class Circle implements Shape
{
    private int $x;
    private int $y;
    private int $radius;

    public function __construct
    (
        private string $color
    ) { }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function setRadius(int $radius): void
    {
        $this->radius = $radius;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function draw(): void
    {
        echo 'Circle: Draw()' . ', color is: ' . $this->color
            . ', x is: ' . $this->x . ', y is: ' . $this->y
            . ', radius is: ' . $this->radius . '<br/>';
    }
}

class ShapeFactory
{
    private array $circleMap = [];

    public function getCircle(string $color): Shape
    {
        foreach($this->circleMap as $circle)
            if($circle->getColor() == $color) return $circle;

        $circle = new Circle($color);
        array_push($this->circleMap, $circle);
        echo '<br/><u><b>Creating circle of color: ' . $color . '</u></b><br/>';

        return $circle;
    }
}

class DemoFlyweightPattern
{
    private array $colors = ['Red', 'Green', 'Blue', 'White', 'Black'];

    public function __construct()
    {
        echo 'FLYWEIGHT DESIGN PATTERN' . '<br/><br/>';

        $shapeFactory = new ShapeFactory();
        for($i = 0; $i < 20; ++$i) {
            $circle = $shapeFactory->getCircle($this->getRandomColor());
            $circle->setX($this->getRandomX());
            $circle->setY($this->getRandomY());
            $circle->setRadius(100);
            $circle->draw();
        }
    }

    public function getRandomColor(): string
    {
        return $this->colors[array_rand($this->colors)];
    }

    public function getRandomX(): int
    {
        return rand(1,100);
    }

    public function getRandomY(): int
    {
        return rand(1,100);
    }
}

$demoFlyweightPattern = new DemoFlyweightPattern();
