<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;


class Chat extends Objects
{

    const TYPE_CHANNEL = 'channel';
    const TYPE_GROUP = 'group';
    const TYPE_SUPER_GROUP = 'supergroup';

    public function getId()
    {
        return $this->data['id'];
    }

    public function isBot()
    {
        return $this->data['is_bot'];
    }

    public function hasUsername()
    {
        return isset($this->data['username']);
    }

    public function getUsername()
    {
        return $this->data['username'];
    }

    public function getFirstname()
    {
        return $this->data['first_name'];
    }

    public function hasLastname()
    {
        return isset($this->data['last_name']);
    }

    public function getLastname()
    {
        return $this->data['last_name'];
    }

    public function hasLanguageCode()
    {
        return isset($this->data['language_code']);
    }

    public function getLanguageCode()
    {
        return $this->data['language_code'];
    }

    public function getType()
    {
        return $this->data['type'];
    }
}