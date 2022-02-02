<?php


namespace zafarjonovich\Telegram\call;

use zafarjonovich\Telegram\call\exception\CallParseException;

class Call
{
    protected $call;

    protected const MAX_CALL_STRING_LENGTH = 64;

    /**
     * Call constructor.
     * @param array $call
     * @throws CallParseException
     */
    public function __construct(array $call = [])
    {
        foreach (static::needPropertyKeys() as $needPropertyKey) {
            static::getValue($call,$needPropertyKey);
        }

        $this->call = $call;
    }

    public static function functionNameConstants()
    {
        return [];
    }

    public static function needPropertyKeys()
    {
        return [];
    }

    /**
     * @param $data
     * @param $key
     * @return mixed
     * @throws CallParseException
     */
    protected static function getValue($data,$key)
    {
        if(!array_key_exists($key,$data)) {
            throw new CallParseException('Call key not found');
        }

        return $data[$key];
    }

    public function __call($name, $arguments)
    {
        $funcNameConstants = static::functionNameConstants();

        if(isset($funcNameConstants[$name])){
            return static::getValue($this->call,$funcNameConstants[$name]);
        }

        return null;
    }

    /**
     * @param $data
     * @param array $keys
     * @throws CallParseException
     */
    protected static function checkCall($data,array $keys)
    {
        foreach ($keys as $key) {
            self::getValue($data,$key);
        }
    }

    protected static function decode($call)
    {
        $call = json_decode($call,true);

        if($call === null) {
            throw new CallParseException('Call is not json');
        }

        return $call;
    }

    /**
     * @param array $options
     * @return string
     * @throws CallParseException
     */
    public function encode(array $options = []):string
    {
        $call = $this->call;

        $call = array_merge($call,$options);

        $json = json_encode($call);

        if($json === false) {
            throw new CallParseException('Added invalid option');
        }

        return $json;
    }

    public static function parse($call)
    {
        return new static(self::decode($call));
    }

    public function get()
    {
        return $this->call;
    }
}