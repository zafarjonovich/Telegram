<?php


namespace zafarjonovich\Telegram\update\traits;


trait CallbackQuery
{
    public function isCallbackQuery()
    {
        return isset($this->data['callback_query']);
    }

    public function getCallbackQuery()
    {
        return new \zafarjonovich\Telegram\update\types\CallbackQuery($this->data['callback_query']);
    }
}