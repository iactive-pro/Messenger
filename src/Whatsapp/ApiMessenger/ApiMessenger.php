<?php declare(strict_types=1);

/**
 * Abstract class of ApiMessenger
 * Api Messenger docs: https://api-messenger.com/documentations/
 */

namespace src\Whatsapp\ApiMessenger;

use Exception;

abstract class ApiMessenger
{
    protected $token = null;

    /** @var Exception */
    protected $exception = null;

    protected function __construct(string $token) {
        $this->token = $token;
    }

    protected $responseBody = null;

    protected $status = null;

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getException()
    {
        return $this->exception;
    }
}