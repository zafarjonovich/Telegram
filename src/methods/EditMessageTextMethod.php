<?php

namespace zafarjonovich\Telegram\methods;

use zafarjonovich\Telegram\base\Method;

class EditMessageTextMethod extends Method
{
    protected $method = 'editMessageText';

    public function __construct($chat_id,$message_id,$text,array $options = [])
    {
        $this->setOptions(
            compact('chat_id','message_id','text'),
            $options
        );
    }
}