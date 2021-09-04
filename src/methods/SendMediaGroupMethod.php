<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendMediaGroupMethod extends Method
{
    protected $method = 'sendMediaGroup';

    public function __construct($chat_id,$media,$options = [])
    {
        $this->setOptions(compact('chat_id','media'),$options);
    }
}