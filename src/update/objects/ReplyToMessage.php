<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\From;
use \zafarjonovich\Telegram\update\traits\Chat;
use zafarjonovich\Telegram\update\traits\Text;

class ReplyToMessage extends Objects
{
    use From,Chat,Text;

    public function getMessageId()
    {
        return $this->data['message_id'];
    }
}