<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendDocumentMethod extends Method
{
    protected $method = 'sendDocument';

    public function __construct($chat_id,$document,$options = [])
    {
        $this->setOptions(compact('chat_id','document'),$options);
    }
}