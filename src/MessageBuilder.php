<?php

namespace zafarjonovich\Telegram;

class MessageBuilder
{

    private const sendMessage = 'sendMessage';
    private const sendPhoto = 'sendPhoto';
    private const sendVideo = 'sendVideo';
    private const sendDocument = 'sendDocument';
    private const sendContact = 'sendContact';


    /** @var string Telegram bot method name */
    public $method;

    /** @var array Telegram bot message data */
    public $data;

    /**
     * MessageBuilder constructor.
     * @param array $params - Telegram bot message properties
     *
     * $params['text'] - Text of message.
     */

    public function __construct(array $params)
    {
        $method = null;

        if(isset($params['method'],$params['content'])and in_array($params['method'],[self::sendPhoto,self::sendVideo,self::sendDocument])){

            $content = null;

            if(filter_var($params['content'], FILTER_VALIDATE_URL) !== false){
                $content = $params['content'];
            }else if(file_exists($params['content'])){
                $content = new \CURLFile($params['content']);
            }

            if($content === null){
                throw new \Exception('Content must be valid');
            }

            $this->data[strtolower(str_replace(['send'],'',$params['method']))] = $content;

            $method = $params['method'];

        }

        if(isset($params['contact'])){

            $method = self::sendContact;
            $this->data['contact'] = $params['contact'];

        }

        if(isset($params['text'])){
            if($method !== null){
                $this->data['caption'] = $params['text'];
            }else{
                $this->data['text'] = $params['text'];
                $method = self::sendMessage;
            }
        }

        if(empty($this->data)){
            throw new \Exception('Params must be valid');
        }

        if(isset($params['parse_mode'])){
            $this->data['parse_mode'] = $params['parse_mode'];
        }

        if(isset($params['reply_markup'])){
            $this->data['reply_markup'] = $params['reply_markup'];
        }

        $this->method = $method;

    }

}