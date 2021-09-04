<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class DeleteMessageMethod extends Method
{
    protected $method = 'deleteMessage';

    public function __construct($chat_id,$message_id)
    {
        $this->options = compact('chat_id','message_id');
    }
}