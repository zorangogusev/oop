<?php

declare(strict_types=1);

/**
 * In Template pattern, an abstract class defines way(s)/template(s) to execute
 * its methods. Its subclasses can override the method implementation as per
 * need but the invocation is to be in the same way as defined by an abstract
 * class.
 */

abstract class Game
{
    public abstract function initialize(): void;
    public abstract function startPlay(): void;
    public abstract function endPlay(): void;

    public final function play(): void
    {
        $this->initialize();
        $this->startPlay();
        $this->endPlay();
    }
}

class Cricket extends Game
{

    public function initialize(): void
    {
        echo 'Cricket Game Initialized! Start playing' . '<br/>';
    }

    public function startPlay(): void
    {
        echo 'Cricket Game Started! Enjoy the game' . '<br/>';
    }

    public function endPlay(): void
    {
        echo 'Cricket Game Finished!' . '<br/>';
    }
}

class Football extends Game
{

    public function initialize(): void
    {
        echo 'Football Game Initialized! Start playing' . '<br/>';
    }

    public function startPlay(): void
    {
        echo 'Football Game Started! Enjoy the game' . '<br/>';
    }

    public function endPlay(): void
    {
        echo 'Football Game Finished!' . '<br/>';
    }
}

class DemoTemplatePattern
{
    public function __construct()
    {
        echo 'TEMPLATE DESIGN PATTERN' . '<br/><br/>';

        $game = new Cricket();
        $game->play();
        echo '<hr>';
        $game = new Football();
        $game->play();
    }
}

$demoTemplatePattern = new DemoTemplatePattern();
