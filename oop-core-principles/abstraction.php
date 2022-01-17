<?php

/**
 * Abstraction, which means to simplify reality and focus on the data and
 * processes that are relevant to the application being built.
 * This mechanism should hide internal implementation details. It should only
 * reveal operations relevant for the other objects.
 *
 * In example below, the class MailService have public and private functions.
 * When we instantiate the class MailService in the class DemoInheritance, the
 * instance is showing only the public method and hiding the private methods
 * and with this we simplify the usage of the class MailService.
 */

class MailService
{
    public function sendEmail()
    {
        $this->connect();
        $this->authenticate();
        $this->send();
        $this->disconnect();
    }

    private function connect(): void
    {
        echo 'Connect' . '<br/>';
    }

    private function disconnect(): void
    {
        echo 'disconnect' . '<br/>';
    }

    private function authenticate(): void
    {
        echo 'authenticate' . '<br/>';
    }

    private function send(): void
    {
        echo 'email is sending...' . '<br/>';
    }

}


class DemoAbstraction
{
    public function __construct()
    {
        $mailService = new MailService();

//        $mailService->
        $mailService->SendEmail();
    }
}

$demoAbstraction = new DemoAbstraction();
