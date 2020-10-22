<?php declare(strict_types=1);


namespace src\Interfaces;


interface SendImageInterface
{
    public function sendImage($to, $imageUrl, $message = '');
}