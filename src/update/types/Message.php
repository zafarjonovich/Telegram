<?php


namespace zafarjonovich\Telegram\update\types;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\From;
use zafarjonovich\Telegram\update\traits\Chat;
use zafarjonovich\Telegram\update\traits\Photo;
use zafarjonovich\Telegram\update\traits\ReplyToMessage;
use zafarjonovich\Telegram\update\traits\Text;
use zafarjonovich\Telegram\update\traits\Document;
use zafarjonovich\Telegram\update\traits\Caption;
use zafarjonovich\Telegram\update\traits\Audio;
use zafarjonovich\Telegram\update\traits\Video;

class Message extends Objects
{
    use ReplyToMessage,Chat,From,Text,Document,Caption,Audio,Video,Photo;

    public function getMessageId()
    {
        return $this->data['message_id'];
    }
}