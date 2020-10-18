<?php declare(strict_types=1);


namespace src\Whatsapp\Chat2Desc;


use Platron\Chat2desk\services\BaseServiceRequest;
use Platron\Chat2desk\services\messages\MessagesPostServiceRequest;
use Platron\Chat2desk\services\messages\MessagesPostServiceResponse;
use src\Interfaces\SendMessageInterface;

class Chat2DescSender extends Chat2Desc implements SendMessageInterface
{
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    protected const TRANSPORT = BaseServiceRequest::TRANSPORT_WHATSAPP;

    public function sendMessage(string $to, string $message): bool
    {
        $service = new MessagesPostServiceRequest();
        $service->setClientId($to);
        $service->setText($message);
        $service->setTransport(static::TRANSPORT);
        $response = new MessagesPostServiceResponse($service->sendRequest($this->token));
        $this->isOk = $response->status === 'success';
        $this->responseBody = $response;
        return $this->isOk();
    }

    public function canSendMessage(string $to): bool
    {
        return true;
    }
}