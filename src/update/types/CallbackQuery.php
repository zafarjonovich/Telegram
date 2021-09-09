<?php


namespace zafarjonovich\Telegram\update\types;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\Chat;
use zafarjonovich\Telegram\update\traits\From;
use zafarjonovich\Telegram\update\traits\Message;

class CallbackQuery extends Objects
{
    use From,Message;

    public function id()
    {
        return $this->data['id'];
    }

    public function getData()
    {
        return $this->data['data'];
    }
}