<?php declare(strict_types=1);

namespace src\Viber\Chat2Desc;

use Platron\Chat2desk\services\BaseServiceRequest;
use src\Whatsapp\Chat2Desc\Chat2DescSender as Sender;

class Chat2DescSender extends Sender
{
    public function __construct(string $token, $channelId)
    {
        parent::__construct($token, $channelId);
    }

    protected const TRANSPORT = BaseServiceRequest::TRANSPORT_VIBER;
}