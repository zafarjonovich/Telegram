<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendPhotoMethod extends Method
{
    protected $method = 'sendPhoto';

    public function __construct($chat_id,$photo,$options = [])
    {
        $this->setOptions(compact('chat_id','photo'),$options);
    }
}