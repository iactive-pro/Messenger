<?php declare(strict_types=1);

namespace src\Whatsapp\Chat2Desc;

use Exception;

abstract class Chat2Desc
{
    protected $token;

    protected $responseBody = null;
    protected $isOk = false;
    /** @var Exception */
    protected $exception = null;

    protected function __construct(string $token) {
        $this->token = $token;
    }


    public function isOk(): ?bool
    {
        return $this->isOk();
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

}