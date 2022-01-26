<?php

declare(strict_types=1);

/**
 * In Abstract Factory pattern there is super-factory which creates other
 * factories. Abstract Factory pattern is when an interface is responsible for
 * creating a factory of related objects without specifying their classes. Each
 * generated factory can give the objects as per the Factory pattern.
 */

interface Shape
{
    public function draw(): void;
}

interface Color
{
    public function fill(): void;
}

class Circle implements Shape
{
    public function draw(): void
    {
        echo 'Here circle->draw() method';
    }
}

class Rectangle implements Shape
{
    public function draw(): void
    {
        echo 'Here rectangle->draw() method';
    }
}

class Square implements Shape
{
    public function draw(): void
    {
        echo 'Here square->draw() method';
    }
}

class Red implements Color
{
    public function fill(): void
    {
        echo 'Here red->fill() method';
    }
}

class Blue implements Color
{
    public function fill(): void
    {
        echo 'Here blue->fill() method';
    }
}

class Green implements Color
{
    public function fill(): void
    {
        echo 'Here green->fill() method';
    }
}

abstract class AbstractColorFactory
{
    abstract public function getColor(string $color): object|null;
}

abstract class AbstractShapeFactory
{
    abstract public function getShape(string $shape): object|null;
}

class ShapeFactory extends AbstractShapeFactory
{
    public function getShape(string $shapeType): object|null
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

class ColorFactory extends AbstractColorFactory
{
    public function getColor(string $color): object|null
    {
        if ($color == null) return null;

        if ($color == 'RED') {
            return new Red();
        } elseif ($color == 'GREEN') {
            return new Green();
        } elseif ($color == 'BLUE') {
            return new Blue();
        }

        return null;
    }
}

class FactoryProducer
{
    public function getFactory(string $choice): object|null
    {
        if($choice == 'SHAPE') {
            return new ShapeFactory();
        } elseif($choice == 'COLOR') {
            return new ColorFactory();
        }

        return null;
    }
}

class DemoAbstractFactoryPattern
{
    public function __construct()
    {
        echo 'ABSTRACT FACTORY DESIGN PATTERN' . '<br/><br/>';

        $shapeFactory = (new FactoryProducer)->getFactory('SHAPE');
        $shape1 = $shapeFactory->getShape('CIRCLE');
        $shape1->draw();
        echo '<br>';
        $shape2 = $shapeFactory->getShape('RECTANGLE');
        $shape2->draw();
        echo '<br>';
        $shape3 = $shapeFactory->getShape('SQUARE');
        $shape3->draw();

        echo '<hr>';

        $colorFactory = (new FactoryProducer)->getFactory('COLOR');
        $color1 = $colorFactory->getColor('RED');
        $color1->fill();
        echo '<br>';
        $color2 = $colorFactory->getColor('GREEN');
        $color2->fill();
        echo '<br>';
        $color3 = $colorFactory->getColor('BLUE');
        $color3->fill();
    }
}

$DemoAbstractFactoryPattern = new DemoAbstractFactoryPattern();
