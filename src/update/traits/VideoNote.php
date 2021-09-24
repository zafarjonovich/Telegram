<?php


namespace zafarjonovich\Telegram\update\traits;


trait VideoNote
{
    public function isVideoNote()
    {
        return isset($this->data['video_note']);
    }

    public function getVideoNote()
    {
        return new \zafarjonovich\Telegram\update\objects\Video($this->data['video_note']);
    }
}