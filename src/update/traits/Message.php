<?php


namespace zafarjonovich\Telegram\update\traits;

trait Message
{
    public function isMessage()
    {
        return isset($this->data['message']);
    }

    public function getMessage()
    {
        return new \zafarjonovich\Telegram\update\types\Message($this->data['message']);
    }
}