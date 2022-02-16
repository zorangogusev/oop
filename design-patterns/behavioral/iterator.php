<?php

declare(strict_types=1);

/**
 * Iterator allows sequential traversal through a complex data structure without
 * exposing its internal details.
 * The PHP has a built-in Iterator interface that can be used for building
 * custom iterators compatible with the rest of the PHP code. More info about it
 * on https://www.php.net/manual/en/class.iterator.php
 */
class AlphabeticalOrderIterator implements \Iterator
{

    public function __construct(private $collection, private $reverse = false)
    { }

    public function rewind()
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

    public function current()
    {
        return $this->collection->getItems()[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid()
    {
        return isset($this->collection->getItems()[$this->position]);
    }
}

class WordsCollection implements \IteratorAggregate
{
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function getIterator(): Iterator
    {
        return new AlphabeticalOrderIterator($this);
    }

    public function getReverseIterator(): Iterator
    {
        return new AlphabeticalOrderIterator($this, true);
    }
}

class DemoIteratorPattern
{
    public function __construct()
    {
        echo 'ITERATOR DESIGN PATTERN' . '<br/><br/>';

        $collection = new WordsCollection();
        $collection->addItem("First");
        $collection->addItem("Second");
        $collection->addItem("Third");

        echo "Straight traversal:<br/>";
        foreach ($collection->getIterator() as $item) {
            echo $item . "<br/>";
        }

        echo "<br/>";

        echo "Reverse traversal:<br/>";
        foreach ($collection->getReverseIterator() as $item) {
            echo $item . "<br/>";
        }
    }
}

$demoIteratorPattern = new DemoIteratorPattern();
