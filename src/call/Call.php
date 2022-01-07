<?php


namespace zafarjonovich\Telegram\call;

use Exception;
use zafarjonovich\Telegram\call\exception\CallParseException;

class Call
{
    protected $call;

    protected const MAX_CALL_STRING_LENGTH = 64;

    /**
     * @var array $call
     * @throws Exception
     */
    public function __construct(array $call = [])
    {
        foreach (static::needPropertyKeys() as $needPropertyKey)
            if(!array_key_exists($needPropertyKey,$call))
                throw new CallParseException('Invalid configuration');

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
        if(!array_key_exists($key,$data))
            throw new CallParseException('Call key not found');

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
            throw new CallParseException('Call is not json');

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

        if (mb_strlen($json) > 64)
            throw new \Exception('More data');

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