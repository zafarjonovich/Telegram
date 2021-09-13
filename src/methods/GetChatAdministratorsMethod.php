<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class GetChatAdministratorsMethod extends Method
{
    protected $method = 'getChatAdministrators';

    public function __construct($chat_id)
    {
        $this->options = $this->merge(
            compact('chat_id')
        );
    }
}