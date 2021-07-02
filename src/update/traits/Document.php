<?php


namespace zafarjonovich\Telegram\update\traits;


trait Document
{
    public function isDocument()
    {
        return isset($this->data['document']);
    }

    public function getDocument()
    {
        return new \zafarjonovich\Telegram\update\objects\Document($this->data['document']);
    }
}