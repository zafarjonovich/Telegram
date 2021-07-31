<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\Caption;
use zafarjonovich\Telegram\update\traits\FileAttributes;

class Video extends Objects
{
    use FileAttributes;

    public function getWidth()
    {
        return $this->data['width'];
    }

    public function getHeight()
    {
        return $this->data['height'];
    }

    public function getDuration()
    {
        return $this->data['duration'];
    }
}