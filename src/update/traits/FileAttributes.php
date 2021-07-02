<?php


namespace zafarjonovich\Telegram\update\traits;


trait FileAttributes
{
    public function getFileId()
    {
        return $this->data['file_id'];
    }

    public function getFileUniqueId()
    {
        return $this->data['get_file_unique_id'];
    }

    public function isThumb()
    {
        return isset($this->data['thumb']);
    }

    public function getThumb()
    {
        return $this->data['thumb'];
    }

    public function isFileName()
    {
        return isset($this->data['file_name']);
    }

    public function getFileName()
    {
        return $this->data['file_name'];
    }

    public function isMineType()
    {
        return isset($this->data['mine_type']);
    }

    public function getMineType()
    {
        return $this->data['mine_type'];
    }

    public function isSize()
    {
        return isset($this->data['file_size']);
    }

    public function getSize()
    {
        return $this->data['file_size'];
    }
}