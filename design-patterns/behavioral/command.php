<?php

declare(strict_types=1);

/**
 *
 * In command pattern request is wrapped under an abject as command and passed
 * to invoker object. Invoker object looks for the appropriate object which can
 * handle this command and passes the command to the corresponding object which
 * executes it.
 */

interface Order
{
    public function execute();
}

class Stock
{
    private string $name = 'ABC';
    private int $quantity = 10;

    public function buy()
    {
        echo 'Stock [ Name: ' . $this->name . ', Quantity: ' . $this->quantity
            . ' ] bought' . '<br/>';
    }

    public function sell()
    {
        echo 'Stock [ Name: ' . $this->name . ', Quantity: ' . $this->quantity
            . ' ] sold' . '<br/>';
    }
}

class BuyStock implements Order
{
    public function __construct(private Stock $abcStock)
    {

    }

    public function execute()
    {
        $this->abcStock->buy();
    }
}

class SellStock implements Order
{
    public function __construct(private Stock $abcStock)
    {

    }

    public function execute()
    {
        $this->abcStock->sell();
    }
}

class Broker
{
    private array $orderList;

    public function takeOrder(Order $order)
    {
        $this->orderList[] = $order;
    }

    public function executeOrders()
    {
        foreach($this->orderList as $order)
            $order->execute();

        $this->orderList = [];
    }
}

class DemoCommandPattern
{
    public function __construct()
    {
        echo 'COMMAND DESIGN PATTERN' . '<br/><br/>';

        $abcStock = new Stock();
        $buyStockOrder = new BuyStock($abcStock);
        $sellStockOrder = new SellStock($abcStock);
        $buyStockOrder1 = new BuyStock($abcStock);
        $broker = new Broker();
        $broker->takeOrder($buyStockOrder);
        $broker->takeOrder($sellStockOrder);
        $broker->takeOrder($buyStockOrder1);
        $broker->executeOrders();
    }
}

$demoCommandPattern = new DemoCommandPattern();
