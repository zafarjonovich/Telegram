<?php


namespace zafarjonovich\Telegram\update\traits;


trait Status
{
    public function isStatus()
    {
        return isset($this->data['status']);
    }

    public function getStatus()
    {
        return $this->data['status'];
    }
}