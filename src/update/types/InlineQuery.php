<?php


namespace zafarjonovich\Telegram\update\types;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\objects\From;

class InlineQuery extends Objects
{
    public function id()
    {
        return $this->data['id'];
    }

    public function getFrom()
    {
        return new From($this->data['from']);
    }

    public function offset()
    {
        return $this->data['offset'];
    }
}