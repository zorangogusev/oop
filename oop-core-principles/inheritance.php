<?php

/**
 * Inheritance is concerned with the relationship between classes. Allows a
 * class to derive its methods and properties from another class. Inheritance
 * might be used to define an extensive hierarchy of super classes(parent) and
 * subclasses(child) type of relationships.
 * The main purpose of inheritance is re-usability (reuse) of code and with this
 * the complexity of the application being build is reduced.
 *
 * In the example below the NecklaceDesign1 and NecklaceDesign2 inherit the
 * common properties and method from the parent class Jewellery and with this
 * the code is reused and the complexity is reduced.
 */

class Jewellery {

    protected float $priceOfMetal = 10000;
    protected float $priceOfService = 20000;

    private function total(): float
    {
        return $this->priceOfMetal + $this->priceOfService;
    }

    public function getTotal($product): void
    {
        echo 'Price of ' . $product . ' without tax is: ' . $this->total() . '<br/>';
    }



}

class NecklaceDesign1 extends Jewellery {
    private float $tax = 100;

    public function printInvoice(): void
    {
        echo 'Price with tax for NecklaceDesign1 is: ' . $this->priceOfMetal +
            $this->priceOfService + $this->tax . '<br/>';
    }

}

class NecklaceDesign2 extends Jewellery {
    private float $tax = 200;

    public function printInvoice(): void
    {
        echo 'Price with tax for NecklaceDesign2 is: ' . $this->priceOfMetal +
            $this->priceOfService + $this->tax . '<br/>';
    }

}

class DemoInheritance
{
    public function __construct()
    {
        $necklaceDesign1= new NecklaceDesign1;
        $necklaceDesign1->getTotal('Necklace');
        $necklaceDesign1->printInvoice('Necklace');
        echo '<br/>';
        $necklaceDesign2= new NecklaceDesign2;
        $necklaceDesign2->getTotal('Ring');
        $necklaceDesign2->printInvoice();
    }
}

$demoInheritance = new DemoInheritance();
