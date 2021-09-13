<?php


namespace zafarjonovich\Telegram\helpers;

use Exception;

class Call
{
    protected $call;

    protected const MAX_CALL_STRING_LENGTH = 64;

    /**
     * @var array $call
     * @throws Exception
     */
    public function __construct(array $call)
    {
        foreach (static::needPropertyKeys() as $needPropertyKey) {
            if(!isset($call[$needPropertyKey]))
                throw new Exception('Invalid configuration');
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
     * @throws Exception
     */
    protected static function getValue($data,$key)
    {
        if(!isset($data[$key]))
            throw new Exception('Call key not found');

        return $data[$key];
    }

    public function __call($name, $arguments)
    {
        $funcNameConstants = static::functionNameConstants();

        if(isset($funcNameConstants[$name])){
            return self::getValue($this->call,$funcNameConstants[$name]);
        }
    }

    /**
     * @param $data
     * @param array $keys
     * @throws Exception
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

        if(!$call)
            throw new Exception('Call is not json');

        return $call;
    }

    /**
     * @param array $options
     * @return string
     * @throws Exception
     */
    public function encode(array $options = []):string
    {
        $call = $this->call;

        $call = array_merge($call,$options);

        $json = json_encode($call);

        if($json === false)
            throw new Exception('Added invalid option');

        if(strlen($json) > self::MAX_CALL_STRING_LENGTH)
            throw new Exception('Call is too long');

        return $json;
    }

    public static function parse($call)
    {
        return new static(self::decode($call));
    }
}