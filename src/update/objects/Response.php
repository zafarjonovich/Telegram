<?php


namespace zafarjonovich\Telegram\update\objects;



use zafarjonovich\Telegram\update\Objects;

class Response extends Objects
{
    public function ok()
    {
        return $this->data['ok'];
    }

    public function getResult()
    {
        return new Result($this->data['result']);
    }
}