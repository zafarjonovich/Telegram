<?php


namespace zafarjonovich\Telegram\update;


class Objects
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get()
    {
        return $this->data;
    }
}