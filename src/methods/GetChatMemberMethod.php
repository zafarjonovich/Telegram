<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class GetChatMemberMethod extends Method
{
    protected $method = 'getChatMember';

    public function __construct($chat_id,$user_id)
    {
        $this->options = $this->merge(
            compact('chat_id','user_id')
        );
    }
}