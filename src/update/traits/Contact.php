<?php


namespace zafarjonovich\Telegram\update\traits;


trait Contact
{
    public function isContact()
    {
        return isset($this->data['contact']);
    }

    public function getContact()
    {
        return new \zafarjonovich\Telegram\update\objects\Contact($this->data['contact']);
    }
}