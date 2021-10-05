<?php


namespace zafarjonovich\Telegram\update\traits;


trait Voice
{
    public function isVoice()
    {
        return isset($this->data['voice']);
    }

    public function getVoice()
    {
        return new \zafarjonovich\Telegram\update\objects\Voice($this->data['voice']);
    }
}