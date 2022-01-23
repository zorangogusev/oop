<?php

/**
 * In Factory pattern, we create objects without exposing the creation logic to
 * the client and refer to newly created object using a common interface.
 */

interface Shape
{
    public function draw(): void;
}

class Rectangle implements Shape
{

    public function draw(): void
    {
        echo 'Inside Rectangle->draw() method';
    }
}

class Square implements Shape
{

    public function draw(): void
    {
        echo 'Inside Square->draw() method';
    }

}
class Circle implements Shape
{

    public function draw(): void
    {
        echo 'Inside Circle->draw() method';
    }
}

class ShapeFactory
{
    public function getShape(string $shapeType): Circle|Rectangle|Square|null
    {
        if ($shapeType == null) return null;

        if ($shapeType == 'CIRCLE') {
            return new Circle();
        } elseif ($shapeType == 'RECTANGLE') {
            return new Rectangle();
        } elseif ($shapeType == 'SQUARE') {
            return new Square();
        }

        return null;
    }
}

class DemoFactoryPattern
{
    public function __construct()
    {
        echo 'FACTORY DESIGN PATTERN' . '<br/><br/>';
        $shapeFactory = new ShapeFactory();
        $shape = $shapeFactory->getShape('CIRCLE');
        $shape->draw();

        echo '<br>';

        $shape = $shapeFactory->getShape('RECTANGLE');
        $shape->draw();

        echo '<br>';

        $shape = $shapeFactory->getShape('SQUARE');
        $shape->draw();
    }
}

$demoFactoryPattern = new DemoFactoryPattern();
