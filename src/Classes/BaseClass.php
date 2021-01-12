<?php

declare(strict_types=1);

namespace src\Classes;

use Exception;

abstract class BaseClass
{
    /**
     * @var string
     */
    protected $token;

    protected $responseBody = null;

    /**
     * @var bool
     */
    protected $isOk = false;

    /** @var Exception */
    protected $exception = null;

    protected function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function isOk(): bool
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
