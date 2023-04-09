<?php

namespace zafarjonovich\Telegram\update\objects;

use zafarjonovich\Telegram\update\Objects;

class ChatMember extends Objects
{
    public function getStatus()
    {
        return $this->data['status'];
    }
}