<?php declare(strict_types=1);

namespace src\Interfaces;

interface SendMessageInterface
{
    public function sendMessage(string $to, string $message): bool;

    public function isOk(): ?bool;

    public function getResponseBody();

    public function canSendMessage(string $to): bool;

}