<?php

/**
 * Object or entities should be open for extension but closed for modification.
 * The class should be extendable without being modified.
 *
 * In the example bellow to achieve the open close principle we implemented
 * interface ShapeInterface to every class and in every class we created method
 * area.
 * Also in the sum method of the class AreaCalculator instead to check if the
 * parameter is instance of given class we are checking if the parameter is
 * implementing the interface ShapeInterface and like this we can use the sum
 * method for more classes that implement ShapeInterface without modifying the
 * class AreaCalculator.
 * If we want to create new class and to use it as parameter in the class
 * AreaCalculator all we need to do is to implement the ShapeInterface on the
 * new class and we will be able to use that class as parameter.
 */

interface ShapeInterface
{
    public function area(): float;
}

class Square implements ShapeInterface
{
    public function __construct(public float $length)
    {

    }

    public function area(): float
    {
        return pow($this->length, 2);
    }
}

class Circle implements ShapeInterface
{
    public function __construct(public float $radius)
    {

    }

    public function area(): float
    {
        return pi() * pow($this->radius, 2);
    }
}

class SumCalculatorOutput
{
    public function __construct(protected AreaCalculator $calculator)
    {

    }

    public function JSON(): string
    {
        $data = ['sum' => $this->calculator->sum(),];

        return json_encode($data);
    }

    public function HTML(): string
    {
        return '<br>Sum of the areas of provided shapes: '
            . $this->calculator->sum() . '<br>';
    }
}

class AreaCalculator
{

    public function __construct(protected array $shapes = [])
    {

    }

    public function sum(): float
    {
        $area = array();
        foreach ($this->shapes as $shape) {
            if(!is_a($shape, 'ShapeInterface'))
                throw new \Exception(
                    'The class is not implementing the ShapeInterface'
                );

            $area[] = $shape->area();
        }

        return array_sum($area);
    }
}

class DemoOpenClosed
{
    public function __construct()
    {
        $shapes = [
            new Circle(2),
            new Square(5),
            new Square(6)
        ];

        $areas = new AreaCalculator($shapes);
        $output = new SumCalculatorOutput($areas);

        echo 'OPEN CLOSED PRINCIPLE' . '<br/><br/>';
        echo $output->JSON();
        echo $output->HTML();
    }
}

$demoOpenClosed = new DemoOpenClosed();
