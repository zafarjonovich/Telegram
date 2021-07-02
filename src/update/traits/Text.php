<?php


namespace zafarjonovich\Telegram\update\traits;


trait Text
{
    public function isText()
    {
        return isset($this->data['text']);
    }

    public function getText()
    {
        return $this->data['text'];
    }
}