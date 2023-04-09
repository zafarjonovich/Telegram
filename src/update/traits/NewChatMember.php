<?php

namespace zafarjonovich\Telegram\update\traits;

trait NewChatMember
{
    public function hasNewChatMember()
    {
        return isset($this->data['new_chat_member']);
    }

    public function getNewChatMember()
    {
        return new \zafarjonovich\Telegram\update\objects\User($this->data['new_chat_member']);
    }
}