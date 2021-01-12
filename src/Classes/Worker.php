<?php

declare(strict_types=1);

namespace src\Classes;

use Exception;

class Worker
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
     * Worker constructor.
     * @param string $token
     * @param string $url
     */
    public function __construct(string $token, string $url)
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
        $args['token'] = $this->token;
        return $this->url . '/' . $method . '?' . http_build_query($args);
    }

    /**
     * @param string $method
     * @param array $args
     * @param string $qmethod
     * @return string
     * @throws Exception
     */
    public function query(string $method, array $args, string $qmethod = 'GET', $isJson = true): string
    {
        $ch = curl_init();
        $url = $this->createUrl($method);

        if ($qmethod == "POST" && isset($args) && is_array($args)) {
            $content = $isJson ? json_encode($args) : $args;
            $contentType = $isJson ? 'application/json' : 'multipart/form-data';

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: ' . $contentType,
                // 'Content-Length: ' . strlen($content)
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        } elseif ($qmethod == "GET" && isset($args) && is_array($args)) {
            $url = $this->createUrl($method, $args);
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        if (strlen($error = curl_error($ch)))
            throw new Exception($error);

        curl_close($ch);
        return $result;
    }
}
