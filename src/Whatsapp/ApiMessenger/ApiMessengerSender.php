<?php declare(strict_types=1);


namespace src\Whatsapp\ApiMessenger;


use src\Interfaces\SendMessageInterface;

class ApiMessengerSender extends ApiMessenger implements SendMessageInterface
{
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    public function sendMessage(string $to, string $message): bool
    {
        $api = new ApiMessengerWorker($this->token);
        try {
            $this->responseBody = $api->sendPhoneMessage($to, $message);
            $this->status = $this->responseBody['status'];
            $this->isOk = $this->responseBody['status'] === 'OK';
            return true;
        } catch (\Exception $exception) {
            $this->exception = $exception;
            return false;
        }
    }

}