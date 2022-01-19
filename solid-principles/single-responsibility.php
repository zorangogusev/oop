<?php

/**
 * A class should have one and only one reason to change, meaning that a class
 * should have only one job.
 *
 * In the example bellow the output of AreaCalculator should be in more than one
 * format and if we add more option for different outputs from the class
 * AreaCalculator we will violate the single responsibility principle.
 * To avoid this we are creating new class for output SumCalculatorOutput
 * that will be responsible for outputting the sum in more than one format and
 * if necessary we can add another function for other formats of outputs in that
 * same class.
 */

class Square
{
    public function __construct(public float $length)
    {

    }
}

class Circle
{
    public function __construct(public float $radius)
    {

    }
}

class SumCalculatorOutput
{
    public function __construct(protected AreaCalculator $areaCalculator)
    {

    }

    public function JSON(): string
    {
        $data = ['sum' => $this->areaCalculator->sum(),];

        return json_encode($data);
    }

    public function HTML(): string
    {
        return '<br>Sum of the areas of provided shapes: '
            . $this->areaCalculator->sum() . '<br>';
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
            if (is_a($shape, 'Square')) {
                $area[] = pow($shape->length, 2);
            } elseif (is_a($shape, 'Circle')) {
                $area[] = pi() * pow($shape->radius, 2);
            }
        }

        return array_sum($area);
    }
}

class DemoSingleResponsibility
{
    public function __construct()
    {
        $shapes = [
            new Circle(2),
            new Square(5),
            new Square(6),
        ];

        $areas = new AreaCalculator($shapes);
        $output = new SumCalculatorOutput($areas);

        echo 'SINGLE RESPONSIBILITY PRINCIPLE' . '<br/><br/>';
        echo $output->JSON();
        echo $output->HTML();
    }
}

$demoSingleResponsibility = new DemoSingleResponsibility();
