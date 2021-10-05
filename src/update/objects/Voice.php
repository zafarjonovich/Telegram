<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\traits\FileAttributes;

class Voice extends Objects
{
    use FileAttributes;

    public function getDuration()
    {
        return $this->data['duration'];
    }
}