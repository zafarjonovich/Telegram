<?php


namespace zafarjonovich\Telegram\update\traits;


trait From
{
    public function isFrom()
    {
        return isset($this->data['from']);
    }

    public function getFrom()
    {
        return new \zafarjonovich\Telegram\update\objects\From($this->data['from']);
    }
}