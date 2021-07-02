<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\From;
use \zafarjonovich\Telegram\update\traits\Chat;

class ReplyToMessage extends Objects
{
    use From,Chat;

    public function getMessageId()
    {
        return $this->data['message_id'];
    }
}