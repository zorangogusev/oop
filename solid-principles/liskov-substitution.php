<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Every subclass or derived class should be substitutable for their base or
 * parent class.
 *
 * In the example bellow in the VolumeCalculator class if we return array(the
 * commented code on line 113 and 114) we will receive warning informing of
 * array to string conversion. To fix this we must return float.
 * Anyway in this example with the return type declaration this warning is
 * replaced with 'Fatal error - Return value must be of type float'.
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

class SumCalculatorOutputter
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

class VolumeCalculator extends AreaCalculator
{
    public function __construct($shapes = [])
    {
        parent::__construct($shapes);
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

//        $sum_of_areas = array_sum($area);
//        return ['sum of the areas' => $sum_of_areas];
        return array_sum($area);
    }
}

class DemoLiskovSubstitution
{
    public function __construct()
    {
        $shapes = [
            new Circle(2),
            new Square(5),
            new Square(6),
        ];

        $areas = new AreaCalculator($shapes);
        $volumes = new VolumeCalculator($shapes);

        $output = new SumCalculatorOutputter($areas);
        $output2 = new SumCalculatorOutputter($volumes);

        echo 'LISKOV SUBSTITUTION PRINCIPLE' . '<br/><br/>';
        echo $output->JSON() . '<br>';
        echo $output->HTML() . '<br>';
        echo '<br>';
        echo $output2->JSON() . '<br>';
        echo $output2->HTML() . '<br>';


    }
}

$demoLiskovSubstitution = new DemoLiskovSubstitution();
