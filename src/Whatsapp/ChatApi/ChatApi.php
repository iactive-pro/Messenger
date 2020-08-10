<?php declare(strict_types=1);

/**
 * Abstract class of ApiMessenger
 * Api Messenger docs: https://api-messenger.com/documentations/
 */

namespace src\Whatsapp\ApiMessenger;

use Exception;

abstract class ChatApi
{
    protected $token;
    protected $key;

    /** @var Exception */
    protected $exception = null;

    protected function __construct(string $token, string $key) {
        $this->token = $token;
        $this->key = $key;
    }

    protected $responseBody = null;

    protected $isOk = false;

    /**
     * @return mixed
     */
    public function isOk(): ?bool
    {
        return $this->isOk;
    }

    /**
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return mixed
     */
    public function getException()
    {
        return $this->exception;
    }
}