<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\FileAttributes;

class Audio extends Objects
{
    use FileAttributes;

    public function getDuration()
    {
        return $this->data['duration'];
    }

    public function getPerformer()
    {
        return $this->data['performer'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }
}