<?php

declare(strict_types=1);

/**
 * Decorator pattern allows a user to add new functionality to an existing
 * object without altering its structure. This patterns act as a wrapper to
 * existing class.
 * This pattern creates a decorator class which wraps the original class and
 * provides additional functionality keeping class methods signature intact.
 */

interface Logger
{
    public function log($msg);
}

class FileLogger implements Logger
{
    public function log($msg)
    {

        echo "<p>Logging to <b>FILE</b>: {$msg}</p>";
    }
}

abstract class LoggerDecorator implements Logger
{
    public function __construct(protected Logger $logger)
    {

    }

    public abstract function log($msg): void;
}


class EmailLogger extends LoggerDecorator
{
    public function log($msg): void
    {
        $this->logger->log($msg);
        echo "<p>Logging to <b>EMAIL</b>: {$msg}</p>";
    }
}

class TextMessageLogger extends LoggerDecorator
{
    public function log($msg): void
    {
        $this->logger->log($msg);
        echo "<p>Logging to <b>TEXT</b>: {$msg}</p>";
    }
}

class PrintLogger extends LoggerDecorator
{
    public function log($msg): void
    {
        $this->logger->log($msg);
        echo "<p>Logging to <b>PRINT</b>: {$msg}</p>";
    }
}

class FaxLogger extends LoggerDecorator
{
    public function log($msg): void
    {
        $this->logger->log($msg);
        echo "<p>Logging to <b>FAX</b>: {$msg}</p>";
    }
}

class DemoDecoratorPattern
{
    public function __construct()
    {
        echo 'DECORATOR DESIGN PATTERN' . '<br/><br/>';

        $log = new FileLogger();
        $log = new TextMessageLogger($log);
        $log = new PrintLogger($log);
        $log = new FaxLogger($log);

        $log->log('saving file...');
    }
}

$demoDecoratorPattern = new DemoDecoratorPattern();
