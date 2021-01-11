<?php

use src\SemySms\SemySmsSender;

define('DIR', 'D:\Programms\OpenServer\domains\Messenger' . '/');

spl_autoload_register(function ($class)
{
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists(DIR . $path))
        
        require_once DIR . $path;
    else
        echo 'Not found: '.$path;
});

$tokenKey = [
    'token' => 'b044824472a6ebda3a8e903c68f7b083',
    'key' => '257986',
];

$smsSender = new SemySmsSender($tokenKey);

$result = $smsSender->sendMessage('+79112583328', 'Здравствуйте!');

var_dump ($result, $smsSender->getResponseBody(), $smsSender->isOk());