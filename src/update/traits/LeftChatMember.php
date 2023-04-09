<?php

namespace zafarjonovich\Telegram\update\traits;

trait LeftChatMember
{
    public function hasLeftChatMember()
    {
        return isset($this->data['left_chat_member']);
    }

    public function getLeftChatMember()
    {
        return new \zafarjonovich\Telegram\update\objects\User($this->data['left_chat_member']);
    }
}