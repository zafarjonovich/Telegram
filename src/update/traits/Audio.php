<?php


namespace zafarjonovich\Telegram\update\traits;


trait Audio
{
    public function isAudio()
    {
        return isset($this->data['audio']);
    }

    public function getAudion()
    {
        return new \zafarjonovich\Telegram\update\objects\Audio($this->data['audio']);
    }
}