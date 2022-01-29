<?php

/**
 * Prototype pattern refers to creating duplicate object while keeping
 * performance in mind.
 * This is implementing a prototype interface which tells to create a clone of
 * the current object.
 * PHP has built-in cloning support and this same thing is achieved with the
 * keyword clone and also can be used the magick method __clone.
 */

interface Duplicate
{
    public function duplicate(): object;
}

class Circle implements Duplicate
{
    private float $radius;

    public function __construct(private float $rad)
    {
        $this->setRadius($rad);
    }

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function setRadius($radius): void
    {
        $this->radius = $radius;
    }

    public function duplicate(): Circle
    {
        return new Circle($this->getRadius());
    }

    public function area(): float
    {
        return pi() * $this->getRadius() * $this->getRadius();
    }

    public function __toString(): string
    {
        return 'The area of the circle is ' . $this->area();
    }
}

class Rectangle implements Duplicate
{
    private string $width;
    private string $height;

    public function __construct(private string $valueW, private string $valueH)
    {
        $this->setWidth($valueW);
        $this->setHeight($valueH);
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function duplicate(): Rectangle
    {
        return new Rectangle($this->getWidth(), $this->getHeight());
    }

    public function area(): float
    {
        return pi() * $this->getWidth() * $this->getHeight();
    }

    public function __toString(): string
    {
        return 'The area of the rectangle is ' . $this->area();
    }
}

class DemoPrototypePattern
{
    public function __construct()
    {
        echo 'PROTOTYPE DESIGN PATTERN' . '<br/><br/>';

        $circle_1 = new Circle(3);
        $circle_2 = $circle_1->duplicate();
        echo $circle_2;
        echo '<br/>';
        echo $circle_2;

        echo '<hr>';

        $rectangle_1 = new Rectangle(3, 5);
        $rectangle_2 = $rectangle_1->duplicate();
        echo $rectangle_1;
        echo '<br/>';
        echo $rectangle_2;
    }
}

$demoPrototypePattern = new DemoPrototypePattern();
