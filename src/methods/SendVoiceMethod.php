<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendVoiceMethod extends Method
{
    protected $method = 'sendVoice';

    public function __construct($chat_id,$voice,$options = [])
    {
        $this->setOptions(compact('chat_id','voice'),$options);
    }
}