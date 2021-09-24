<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class SendVideoNoteMethod extends Method
{
    protected $method = 'sendVideoNote';

    public function __construct($chat_id,$video_note,$options = [])
    {
        $this->setOptions(compact('chat_id','video_note'),$options);
    }
}