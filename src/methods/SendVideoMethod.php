<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendVideoMethod extends Method
{
    protected $method = 'sendVideo';

    public function __construct($chat_id,$video,$options = [])
    {
        $this->setOptions(compact('chat_id','video'),$options);
    }
}