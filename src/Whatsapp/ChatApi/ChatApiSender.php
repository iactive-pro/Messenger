<?php declare(strict_types=1);

namespace src\Whatsapp\ChatApi;

use src\Interfaces\SendImageInterface;
use src\Interfaces\SendMessageInterface;

class ChatApiSender extends ChatApi implements SendMessageInterface, SendImageInterface
{
    public function __construct(string $token, string $key)
    {
        parent::__construct($token, $key);
    }

    public function sendMessage(string $to, string $message): bool
    {
        $api = new ChatApiWorker($this->token, $this->key);
        try {
            $this->responseBody = $api->sendPhoneMessage($to, $message);
            $this->isOk = $this->responseBody['sent'];
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

    public function sendImage($to, $imageUrl, $message = '')
    {
        $api = new ChatApiWorker($this->token, $this->key);
        try {
            $this->responseBody = $api->sendFile($to, $imageUrl, basename($imageUrl), $message);
            $this->isOk = $this->responseBody['sent'];
            return true;
        } catch (\Exception $exception) {
            $this->exception = $exception;
            return false;
        }
    }
}