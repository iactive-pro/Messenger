<?php declare(strict_types=1);
namespace src\VK;

use src\Interfaces\SendMessageInterface;
use Throwable;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class VkMessagesSender extends VkMessages implements SendMessageInterface
{
    private $groupId;
    
    public function __construct(string $access_token, string $groupId)
    {
        parent::__construct($access_token);
        $this->groupId = $groupId;
    }

    public function sendMessage(string $to, string $message): bool 
    {
        try {

            $result = $this->vk->messages()->send($this->token, [
            'user_id' => $to,
            'random_id' => rand(),
            'message' => $message,
            ]);

            $this->isOk = true;

            $this->responseBody = $result;

            return true;
        } catch (Throwable $e) {
            
            $this->isOk = false;

            $this->responseBody = [
                'exceptionMessage' => $e->getMessage(),
                'errorCode' => $e->getCode(),
                'messageText' => $message,
                'user_id' => $to,
            ];

            return false;
        }
    }

    public function canSendMessage(string $to): bool
    {
        try {
            $d = $this->vk->messages()->isMessagesFromGroupAllowed($this->token, [
                'group_id' => $this->groupId, 'user_id' => $to
            ]);
            return $d['is_allowed'] === 1;
        } catch (VKApiException $e) {
            return false;
        } catch (VKClientException $e) {
            return false;
        }
    }
}