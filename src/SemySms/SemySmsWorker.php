<?php
namespace src\SemySms;

use src\Classes\Worker;
use Exception;

class SemySmsWorker extends Worker
{
    /**
     * @var string
     */
    protected $deviceId;

    /**
     * SemySmsWorker constructor.
     * @param string $token
     * @param string $deviceId
     * @param string $url
     */
    public function __construct(string $token, string $deviceId, string $url = 'https://semysms.net/api/3')
    {
        parent::__construct($token, $url);
        $this->deviceId = $deviceId;
    }

    /**
     * @param string $phone
     * @param string $text
     * @return array
     * @throws Exception
     */
    public function sendSmsMessage(string $phone, string $text)
    {
        $args = [
            'phone' => $phone,
            'msg' => $text,
            'device' => $this->deviceId,
        ];
        return json_decode($this->query('sms.php', $args, "POST", false), true);
    }
}
