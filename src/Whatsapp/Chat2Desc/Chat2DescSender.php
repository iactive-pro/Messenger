<?php declare(strict_types=1);


namespace src\Whatsapp\Chat2Desc;


use Platron\Chat2desk\services\BaseServiceRequest;
use Platron\Chat2desk\services\messages\MessagesPostServiceRequest;
use Platron\Chat2desk\services\messages\MessagesPostServiceResponse;
use src\Interfaces\SendImageInterface;
use src\Interfaces\SendMessageInterface;

class Chat2DescSender extends Chat2Desc implements SendMessageInterface, SendImageInterface
{
    private $channelId;
    public function __construct(string $token, $channelId)
    {
        parent::__construct($token);
        $this->channelId = $channelId;
    }

    protected const TRANSPORT = BaseServiceRequest::TRANSPORT_WHATSAPP;

    public function sendMessage(string $to, string $message): bool
    {
        return $this->send($to, $message);
    }

    private function send($to, $message, $imageUrl = '') {
        $service = new MessagesPostServiceRequest();
        $service->setClientId($to);
        $service->setText($message);
        $service->setChannelId($this->channelId);
        $service->setTransport(static::TRANSPORT);
        $service->setAttachment($imageUrl);
        $rsp = $service->sendRequest($this->token);
        $response = new MessagesPostServiceResponse($rsp);
        $this->isOk = $response->status === 'success';
        $this->responseBody = $response;
        return $this->isOk();
    }


    public function canSendMessage(string $to): bool
    {
        return true;
    }

    public function sendImage($to, $imageUrl, $message = '') {
        return $this->send($to, $message, $imageUrl);
    }
}