<?php


namespace zafarjonovich\Telegram\update;



use zafarjonovich\Telegram\update\traits\CallbackQuery;
use zafarjonovich\Telegram\update\traits\Message;
use zafarjonovich\Telegram\update\types\InlineQuery;

class Update extends Objects
{
    use Message,CallbackQuery;

    public function isInlineQuery()
    {
        return isset($this->data['inline_query']);
    }

    public function getInlineQuery()
    {
        return new InlineQuery($this->data['inline_query']);
    }
}