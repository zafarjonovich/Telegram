<?php


namespace zafarjonovich\Telegram\base;


class MethodOption
{
    private $options = [];

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function exist($name)
    {
        return isset($this->options[$name]);
    }

    public function set($name,$value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    public function get($name)
    {
        if(!$this->exist($name))
            throw new \Exception('Property not found');

        return $this->options[$name];
    }

    public function toArray()
    {
        return $this->options;
    }
}