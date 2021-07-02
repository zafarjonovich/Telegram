<?php


namespace zafarjonovich\Telegram\update\traits;

use zafarjonovich\Telegram\update\objects\Chat as ChatObject;

trait Chat
{
    public function isChat()
    {
        return isset($this->data['chat']);
    }

    public function getChat()
    {
        return new ChatObject($this->data['chat']);
    }
}