<?php

declare(strict_types=1);

/**
 * Bridge is used when we need to decouple an abstraction from its
 * implementation so that the two can vary independently. This pattern involves
 * an interface which acts as a bridge which makes the functionality of concrete
 * classes independent from interface implementer classes.
 */

interface BridgeDrawApi
{
    public function drawCircle(int $radius, int $x, int $y): void;
}

class RedCircle implements BridgeDrawApi
{
    public function drawCircle(int $radius, int $x, int $y): void
    {
        echo 'Drawing Circle color: Red, radius: ' . $radius . ', x: ' . $x
            . ', y: ' . $y;
    }
}

class GreenCircle implements BridgeDrawApi
{
    public function drawCircle(int $radius, int $x, int $y): void
    {
        echo 'Drawing Circle color: Green, radius: ' . $radius . ', x: ' . $x
            . ', y: ' . $y;
    }
}

abstract class Shape
{
    protected function __construct(protected BridgeDrawApi $drawApi) { }

    public abstract function draw(): void;
}

class Circle extends Shape
{
    public function __construct(
        public int $x,
        public int $y,
        public int $radius,
        public BridgeDrawApi $drawApi
    )
    {
        parent::__construct($drawApi);
    }


    public function draw(): void
    {
        echo $this->drawApi->drawCircle($this->radius, $this->x, $this->y);
    }
}

class DemoBridgePattern
{
    public function __construct()
    {
        echo 'BRIDGE DESIGN PATTERN' . '<br/><br/>';

        $redCircle = new Circle(100, 100, 10, new RedCircle());
        $greenCircle = new Circle(100, 100, 10, new GreenCircle());
        $redCircle->draw();
        echo '<br/>';
        $greenCircle->draw();
    }
}

$demoBridgePattern = new DemoBridgePattern();