<?php declare(strict_types=1);

namespace src\Interfaces;

interface SendMessageInterface
{
    public function sendMessage(string $to, string $message): bool;

    public function isOk();

    public function getResponseBody();

}