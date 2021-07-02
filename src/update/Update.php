<?php


namespace zafarjonovich\Telegram\update;



use zafarjonovich\Telegram\update\traits\CallbackQuery;
use zafarjonovich\Telegram\update\traits\Message;

class Update extends Objects
{
    use Message,CallbackQuery;
}