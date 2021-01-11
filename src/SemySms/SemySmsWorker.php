<?php
namespace src\SemySms;

use Exception;

class SemySmsWorker
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $url = '';

    /**
     * ApiMessenger constructor.
     * @param string $token
     * @param string $url
     */
    public function __construct(array $token, string $url = 'https://semysms.net/api/3')
    {
        $this->token = $token;
        $this->url = $url;
    }

    /**
     * @param $method
     * @param array $args
     * @return string
     */
    public function createUrl(string $method, array $args = []): string
    {
        $args['token'] = $this->token['token'];
        $args['device'] = $this->token['key'];
        return $this->url.'/'.$method.'?'.http_build_query($args);
    }

    /**
     * @param string $method
     * @param array $args
     * @param string $qmethod
     * @return string
     * @throws Exception
     */
    public function query(string $method, array $args, string $qmethod = 'GET'): string
    {
        
        $ch = curl_init();
        $url = $this->createUrl($method);

        if($qmethod == "POST" && isset($args) && is_array($args)) {
            // $content = json_encode($args);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: multipart/form-data',
            //     'Content-Length: ' . strlen($content)
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        } elseif($qmethod == "GET" && isset($args) && is_array($args)) {
            $url = $this->createUrl($method, $args);
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        if(strlen($error = curl_error($ch)))
            throw new Exception($error);

        curl_close($ch);
        return $result;
    }

    /**
     * @param string $phone
     * @param string $text
     * @return array
     * @throws Exception
     */
    public function sendSmsMessage(string $phone, string $text)
    {
        return json_decode($this->query('sms.php', ['phone' => $phone, 'msg' => $text], "POST"), 1);
    }
}
