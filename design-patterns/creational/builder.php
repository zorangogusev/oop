<?php

/**
 * Builder pattern builds a complex object using simple objects and using a step
 * by step approach. A Builder class builds the final object step by step and is
 * independent of other objects.
 */

interface Packing
{
    public function pack(): string;
}

interface Category
{
    public function prepare(): Packing;
}

interface Item
{
    public function name(): string;
    public function price(): float;
}

class Food implements Packing
{
    public function pack(): string
    {
        return 'Food';
    }
}

class Drink implements Packing
{
    public function pack(): string
    {
        return 'Drinks';
    }
}

class Burger implements Category
{
    public function prepare(): Packing
    {
        return new Food();
    }
}

class ColdDrink implements Category
{
    public function prepare(): Packing
    {
        return new Drink();
    }

}

class Pepsi extends ColdDrink implements Item
{
    public function price(): float
    {
        return 35.0;
    }

    public function name(): string
    {
        return 'Pepsi';
    }
}

class Coke extends ColdDrink implements Item
{
    public function price(): float
    {
        return 30.0;
    }

    public function name(): string
    {
        return 'Coke';
    }
}

class VegBurger extends Burger implements Item
{
    public function price(): float
    {
        return 25.0;
    }

    public function name(): string
    {
        return 'Veg Burger';
    }
}

class ChickenBurger extends Burger implements Item
{
    public function price(): float
    {
        return 50.0;
    }

    public function name(): string
    {
        return 'Chicker Burger';
    }
}

class Meal
{
    private array $items = [];

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getCost(): float
    {
        $cost = 0.0;
        foreach($this->items as $item) {
            $cost += $item->price();
        }

        return $cost;
    }

    public function showItems(): void
    {
        foreach($this->items as $item) {
            echo 'Item: ' . $item->name() . '<br>';
            echo 'Packing: ' . $item->prepare()->pack() . '<br>';
            echo 'Price: ' . $item->price() . '<br>';

        }
    }

}

class MealBuilder
{
    public function prepareVegMeal(): object
    {
        $meal = new Meal();
        $meal->addItem(new VegBurger);
        $meal->addItem(new Coke);

        return $meal;
    }

    public function  prepareNonVegMeal(): object
    {
        $meal = new Meal();
        $meal->addItem(new ChickenBurger());
        $meal->addItem(new Pepsi());

        return $meal;
    }
}

class DemoBuilderPattern
{
    public function __construct()
    {
        $mealBuilder = new MealBuilder();

        $vegMeal = $mealBuilder->prepareVegMeal();
        echo 'Veg Meal' . '<br>';
        $vegMeal->showItems();
        echo '<br>';
        echo 'Total Cost: ' . $vegMeal->getCost();

        echo '<hr>';

        $nonVegMeal = $mealBuilder->prepareNonVegMeal();
        echo 'Non-Veg Meal' . '<br>';
        $nonVegMeal->showItems();
        echo '<br>';
        echo 'Total Cost: ' . $nonVegMeal->getCost();
    }
}

$DemoBuilderPattern = new DemoBuilderPattern();
