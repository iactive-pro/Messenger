<?php declare(strict_types=1);
namespace src\VK;


use \VK\Client\VKApiClient;

abstract class VkMessages
{
    protected $token = null;

    protected $isOk = false;

    protected $responseBody = null;

    protected $vk; 

    protected function __construct(string $access_token) 
    {
        $this->vk = new VKApiClient();
        $this->token = $access_token;
    }

    public function isOk(): ?bool
    {
        return $this->isOk;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }
};