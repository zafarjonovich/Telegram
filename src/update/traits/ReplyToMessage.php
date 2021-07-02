<?php


namespace zafarjonovich\Telegram\update\traits;


trait ReplyToMessage
{
    public function isReplyToMessage()
    {
        return isset($this->data['reply_to_message']);
    }

    public function getReplyToMessage()
    {
        return new \zafarjonovich\Telegram\update\objects\ReplyToMessage($this->data['reply_to_message']);
    }
}