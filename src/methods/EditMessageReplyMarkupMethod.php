<?php

namespace zafarjonovich\Telegram\methods;

use zafarjonovich\Telegram\base\Method;

class EditMessageReplyMarkupMethod extends Method
{
    protected $method = 'editMessageReplyMarkup';

    public function __construct($chat_id,$message_id,$reply_markup,array $options = [])
    {
        $this->setOptions(
            compact('chat_id','message_id','reply_markup'),
            $options
        );
    }
}