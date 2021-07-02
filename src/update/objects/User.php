<?php


namespace zafarjonovich\Telegram\update\objects;


class User
{
    private $user;

    public function __construct($chat)
    {
        $this->user = $chat;
    }

    public function getId()
    {
        return $this->user['id'];
    }
}