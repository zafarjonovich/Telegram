<?php
namespace zafarjonovich\Telegram\base;

class Method
{
    protected $method;

    protected $options = [];

    public function getName()
    {
        return $this->method;
    }

    public function getOptions()
    {
        return $this->options;
    }

    protected function merge($requiredOptions,$options = [])
    {
        return array_merge($requiredOptions,$options);
    }

    protected function setOptions($required_options,$options = [])
    {
        $this->options = $this->merge($required_options,$options);
    }
}