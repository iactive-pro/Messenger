<?php

declare(strict_types=1);

namespace src\SemySms;

use src\Classes\BaseClass;
use src\Interfaces\SendMessageInterface;
use Exception;

class SemySmsSender extends BaseClass implements SendMessageInterface
{
    /**
     * @var string
     */
    protected $deviceId;

    public function __construct(string $token, string $deviceId)
    {
        parent::__construct($token);
        $this->deviceId = $deviceId;
    }

    public function sendMessage(string $to, string $message): bool
    {
        $phone = $this->numberFormatting($to);
        $text = $this->textFormatting($message);

        $api = new SemySmsWorker($this->token, $this->deviceId);
        try {
            $this->responseBody = $api->sendSmsMessage($phone, $text);
            $this->status = $this->responseBody['code'];
            $this->isOk = $this->responseBody['code'] === "0";
            return true;
        } catch (\Exception $exception) {
            $this->exception = $exception;
            return false;
        }
    }

    private function numberFormatting(string $phone)
    {
        $phoneArray = str_split($phone);
        $newStr = '';

        foreach ($phoneArray as $item) {
            if (ctype_digit($item)) $newStr .= $item;
        }

        if (strlen($newStr) > 0)
            return (string) '+' . $newStr;
        else
            throw new Exception('The phone number: ' . $phone . ' is not valid');
    }

    private function textFormatting(string $text)
    {
        if (strlen($text) > 1000)
            throw new Exception('Text cannot be more than 1000');
        else 
            return $text;
    }

    public function canSendMessage(string $to): bool
    {
        return true;
    }
}
