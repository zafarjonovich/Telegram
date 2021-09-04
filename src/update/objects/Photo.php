<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;
use zafarjonovich\Telegram\update\objects\Document;

class Photo extends Objects
{
    public function countOfOptions()
    {
        return count($this->data);
    }

    public function getOption($index)
    {
        if($index < 0 or $index > $this->countOfOptions() - 1)
            throw new \Exception('Invalid index');

        return new Document($this->data[$index]);
    }
}