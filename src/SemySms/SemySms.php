<?php declare(strict_types=1);

namespace src\SemySms;

use Exception;

abstract class SemySms
{
    protected $tokenAndId;

    /** @var Exception */
    protected $exception = null;

    protected function __construct(array $tokenAndId) {
        $this->tokenAndId = $tokenAndId;
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