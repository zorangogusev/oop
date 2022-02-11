<?php

declare(strict_types=1);

/**
 * The chain of responsibility pattern creates a chain of receiver objects for a
 * request. This pattern decouples sender and receiver of a request based on
 * type of request. In this pattern, normally each receiver contains reference
 * to another receiver. If one object cannot handle the request then it passes
 * the same to the next receiver and so on.
 */

abstract class AbstractLogger
{
    public static int $info = 1;
    public static int $debug = 2;
    public static int $error = 3;

    protected int $level;
    protected ?AbstractLogger $nextLogger = null;

    public function setNextLogger(AbstractLogger $nextLogger): void
    {
        echo 'type of $nextLogger is: ' . gettype($nextLogger) . '<br/>';
        $this->nextLogger = $nextLogger;
    }

    public function logMessage(int $level, string $message): void
    {
        if($this->level <= $level) $this->write($message);

        if($this->nextLogger != null)
            $this->nextLogger->logMessage($level, $message);
    }

    abstract public function write(string $message): void;
}

class ConsoleLogger extends AbstractLogger
{
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function write(string $message): void
    {
        echo 'Standard Console::Logger: ' . $message . '<br/>';
    }
}

class FileLogger extends AbstractLogger
{
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function write(string $message): void
    {
        echo 'File::Logger: ' . $message . '<br/>';
    }
}

class ErrorLogger extends AbstractLogger
{
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function write(string $message): void
    {
        echo 'Error Console::Logger: ' . $message . '<br/>';
    }
}

class DemoChainOfResponsibility
{
    public function __construct()
    {
        echo 'CHAIN OF RESPONSIBILITY DESIGN PATTERN' . '<br/><br/>';

        $loggerChain = $this->getChainOfLoggers();
        $loggerChain->logMessage(AbstractLogger::$info,
            'This is information');
        echo '<br/>';
        $loggerChain->logMessage(AbstractLogger::$debug,
            'This is debug level information');
        echo '<br/>';
        $loggerChain->logMessage(AbstractLogger::$error,
            'This is error information');

    }

    private function getChainOfLoggers(): AbstractLogger
    {
        $errorLogger = new ErrorLogger(AbstractLogger::$error);
        $debugLogger = new FileLogger(AbstractLogger::$debug);
        $infoLogger = new ConsoleLogger(AbstractLogger::$info);

        $errorLogger->setNextLogger($debugLogger);
        $debugLogger->setNextLogger($infoLogger);

        return $errorLogger;
    }
}

$demoChainOfResponsibility = new DemoChainOfResponsibility();
