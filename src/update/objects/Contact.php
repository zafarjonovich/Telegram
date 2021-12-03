<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\FileAttributes;

class Contact extends Objects
{
    public function getPhoneNumber()
    {
        return $this->data['phone_number'];
    }

    public function isUserId()
    {
        return isset($this->data['user_id']);
    }

    public function getUserId()
    {
        return $this->data['user_id'];
    }

    public function getFirstName()
    {
        return $this->data['first_name'];
    }

    public function isLastName()
    {
        return isset($this->data['last_name']);
    }

    public function getLastName()
    {
        return $this->data['last_name'];
    }
}