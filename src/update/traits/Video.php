<?php


namespace zafarjonovich\Telegram\update\traits;


trait Video
{
    public function isVideo()
    {
        return isset($this->data['video']);
    }

    public function getVideo()
    {
        return new \zafarjonovich\Telegram\update\objects\Video($this->data['video']);
    }
}