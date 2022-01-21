<?php

/**
 * A class should never be forced to implement an interface that it doesn't use
 * or class shouldn't be forced to depend on methods they do not use.
 *
 * In the example bellow to be able to calculate the volume of the cuboid and
 * implement the interface segregation principle we are creating two more
 * interfaces ThreeDimensionalShapeInterface and ManageShapeInterface. With this
 * segregation we are not forcing the classes to implement methods that they
 * don't need.
 */

interface ShapeInterface
{
    public function area(): float;
    public function calculate(): float;
}

interface ThreeDimensionalShapeInterface
{
    public function volume(): float;
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

    public function calculate(): float
    {
        return $this->area();
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

    public function calculate(): float
    {
        return $this->area();
    }
}

class Cuboid implements ShapeInterface, ThreeDimensionalShapeInterface
{
    public function __construct(
        public float $length,
        public float $width,
        public float $height
    ){

    }

    public function area(): float
    {
        return (2 * $this->length) + (2 * $this->length * $this->height)
            + (2 * $this->height * $this->width);
    }

    public function volume(): float
    {
        // calculate the volume
    }

    public function calculate(): float
    {
        return $this->area();
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
        return 'Sum of the areas of provided shapes: '
            . $this->calculator->sum();
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
                    'The class is not implementing the ManageShapeInterface'
                );

            $area[] = $shape->calculate();
        }

        return array_sum($area);
    }

}

class DemoInterfaceSegregation
{
    public function __construct()
    {
        $shapes = [
            new Circle(2),
            new Square(5),
            new Square(6),
            new Cuboid(6, 5, 9),
        ];

        $areas_1 = new AreaCalculator($shapes);
        $output = new SumCalculatorOutput($areas_1);

        echo 'INTERFACE SEGREGATION PRINCIPLE' . '<br/><br/>';
        echo $output->JSON() . '<br>';
        echo $output->HTML() . '<br>';
    }
}

$demoInterfaceSegregation = new DemoInterfaceSegregation();
