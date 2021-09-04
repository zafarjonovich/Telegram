<?php

namespace zafarjonovich\Telegram\methods;

use zafarjonovich\Telegram\base\Method;

class SendMessageMethod extends Method
{
    protected $method = 'sendMessage';

    public function __construct($chat_id,$text,array $options = [])
    {
        $this->options = $this->merge(
            compact('chat_id','text'),
            $options
        );
    }
}