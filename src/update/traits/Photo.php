<?php


namespace zafarjonovich\Telegram\update\traits;


trait Photo
{
    public function isPhoto()
    {
        return isset($this->data['photo']);
    }

    public function getPhoto()
    {
        return new \zafarjonovich\Telegram\update\objects\Photo($this->data['photo']);
    }
}