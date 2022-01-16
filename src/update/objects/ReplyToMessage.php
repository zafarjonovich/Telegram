<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\From;
use \zafarjonovich\Telegram\update\traits\Chat;
use zafarjonovich\Telegram\update\traits\Text;
use zafarjonovich\Telegram\update\traits\Photo;
use zafarjonovich\Telegram\update\traits\Document;
use zafarjonovich\Telegram\update\traits\Video;
use zafarjonovich\Telegram\update\traits\Audio;
use zafarjonovich\Telegram\update\traits\Voice;
use zafarjonovich\Telegram\update\traits\VideoNote;

class ReplyToMessage extends Objects
{
    use From,Chat,Text,Photo,Video,Document,Audio,Voice,VideoNote;

    public function getMessageId()
    {
        return $this->data['message_id'];
    }
}