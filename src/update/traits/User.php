<?php


namespace zafarjonovich\Telegram\update\traits;

use zafarjonovich\Telegram\update\objects\User as UserObject;

trait User
{
    public function isUser()
    {
        return isset($this->data['user']);
    }

    public function getUser()
    {
        return new UserObject($this->data['user']);
    }
}