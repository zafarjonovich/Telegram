<?php


namespace zafarjonovich\Telegram\update\traits;


trait Caption
{
    public function isCaption()
    {
        return isset($this->data['caption']);
    }

    public function getCaption()
    {
        return $this->data['caption'];
    }
}