<?php

declare(strict_types=1);

/**
 * In proxy pattern, a class represents functionality of another class.
 * We create object having original object to interface its functionality to
 * outer world.
 */

interface Image
{
    public function display(): void;
}

class RealImage implements Image
{
    public function __construct(
        private string $filename
    ) {
        $this->loadFromDisk($this->filename);
    }

    public function display(): void
    {
        echo 'Displaying ' . $this->filename;
    }

    public function loadFromDisk(string $filename): void
    {
        echo 'Loading Image From Disk' . '<br/>';
        echo 'Loading ' . $filename . '...<br/><br/>';
    }
}

class ProxyImage implements Image
{
    public ?Image $realImage = null;

    public function __construct(
        private string $filename
    ) { }

    public function display(): void
    {
        if($this->realImage == null) {
            $this->realImage = new RealImage($this->filename);
        }
        $this->realImage->display();
    }
}

class DemoProxyPattern
{
    public function __construct()
    {
        $image = new ProxyImage('test_10mb.jpg');
        $image->display();
        echo '<br/>';
        /** next display of image will not be loaded from disk */
        $image->display();
    }
}

$demoProxyPattern = new DemoProxyPattern();
