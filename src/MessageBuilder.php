<?php

namespace zafarjonovich\Telegram;

class MessageBuilder
{
    const sendMessage = 'sendMessage';
    const sendPhoto = 'sendPhoto';
    const sendVideo = 'sendVideo';
    const sendDocument = 'sendDocument';
    const sendContact = 'sendContact';


    /** @var string Telegram bot method name */
    private $method;

    /** @var array Telegram bot message data */
    private $data = [];

    /**
     * MessageBuilder constructor.
     * @param array $params - Telegram bot message properties
     *
     * $params['text'] - Text of message.
     */

    public function __construct(array $params)
    {
        $method = null;

        if(isset($params['method'],$params['content']) && in_array($params['method'],[self::sendPhoto,self::sendVideo,self::sendDocument])){

            $content = null;

            if(filter_var($params['content'], FILTER_VALIDATE_URL) !== false) {
                $content = $params['content'];
            }else if(file_exists($params['content'])){
                $content = new \CURLFile($params['content']);
            }

            if($content === null){
                throw new \Exception('Content must be valid');
            }
            
            $this->data[strtolower(str_replace(['send'],'',$params['method']))] = $content;

            $method = $params['method'];

            unset($params['method'],$params['content']);
        }

        if (isset($params['photo'])) {
            $method = self::sendPhoto;
        }

        if (isset($params['video'])) {
            $method = self::sendVideo;
        }

        if (isset($params['document'])) {
            $method = self::sendDocument;
        }
        
        if (isset($params['method'])) {
            $method = $params['method'];
            unset($params['method']);
        }

        if(isset($params['contact'])){
            $method = self::sendContact;
            $this->data['contact'] = $params['contact'];
        }

        if(isset($params['text'])) {
            if($method !== null) {
                $this->data['caption'] = $params['text'];
            }else{
                $this->data['text'] = $params['text'];
                $method = self::sendMessage;
            }
        }

        $this->data = array_merge($params,$this->data);

        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getProperties()
    {
        return $this->data;
    }
}