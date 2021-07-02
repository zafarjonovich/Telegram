<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;

class From extends Objects
{
    public function getId()
    {
        return $this->data['id'];
    }

    public function isBot()
    {
        return $this->data['is_bot'];
    }
}