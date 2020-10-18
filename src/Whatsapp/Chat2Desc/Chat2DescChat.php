<?php declare(strict_types=1);


namespace src\Whatsapp\Chat2Desc;


use Platron\Chat2desk\SdkException;
use Platron\Chat2desk\services\clients\ClientsGetServiceRequest;

class Chat2DescChat
{
    private $token;
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getClientId(string $phone) {
        $service = new ClientsGetServiceRequest();
        $service->setPhone($phone);
        $rsp = $service->sendRequest($this->token);
        if ($rsp->status === 'success')
            return $rsp->data[0]->id;
        else throw new SdkException('Error while sending');

    }

}