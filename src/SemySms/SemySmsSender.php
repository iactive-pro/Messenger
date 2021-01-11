<?php declare(strict_types=1);

namespace src\SemySms;

use src\Interfaces\SendMessageInterface;

class SemySmsSender extends SemySms implements SendMessageInterface
{
    public function __construct(array $tokenAndId)
    {
        parent::__construct($tokenAndId);
    }

    public function sendMessage(string $to, string $message): bool
    {
        $api = new SemySmsWorker($this->tokenAndId);
        try {
            $this->responseBody = $api->sendSmsMessage($to, $message);
            $this->status = $this->responseBody['code'];
            $this->isOk = $this->responseBody['code'] === "0";
            return true;
        } catch (\Exception $exception) {
            $this->exception = $exception;
            return false;
        }
    }

    public function canSendMessage(string $to): bool
    {
        return true;
    }
}