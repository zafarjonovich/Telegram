<?php


namespace zafarjonovich\Telegram;


class Keyboard
{
    const TYPE_INLINE = 'TYPE_INLINE';
    const TYPE_CUSTOM = 'TYPE_CUSTOM';
    const TYPE_REMOVE_CUSTOM_KEYBOARD = 'TYPE_REMOVE_CUSTOM_KEYBOARD';

    private $keyboard = [];

    private $row = 0;

    protected $type;

    protected $onetime = false;

    protected $resize = true;

    public function __construct($keyboard = null)
    {
        if($keyboard instanceof Keyboard){
            $this->type = $keyboard->type;
            $keyboard = $keyboard->get();
        }

        if(is_array($keyboard)){
            $this->keyboard = $keyboard;
            $this->row = count($keyboard) != 0?count($keyboard):0;
        }
    }

    public function onetime()
    {
        $this->onetime = true;
        return $this;
    }

    public function bigSize()
    {
        $this->resize = false;
        return $this;
    }

    public function addCustomButton($text)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_CUSTOM;

        if($this->type !== self::TYPE_CUSTOM)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text];

        return $this;
    }

    public function addRequestContactButton($text)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_CUSTOM;

        if($this->type !== self::TYPE_CUSTOM)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'request_contact'=>true];

        return $this;
    }

    public function addRequestLocationButton($text)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_CUSTOM;

        if($this->type !== self::TYPE_CUSTOM)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'request_location'=>true];

        return $this;
    }

    public function addCallbackDataButton($text,$callback_data)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text, 'callback_data'=> (string)$callback_data];

        return $this;
    }

    public function addUrlButton($text,$url)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'url'=>$url];

        return $this;
    }

    public function addSwitchInlineQueryButton($text,$query)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query'=>$query];

        return $this;
    }

    public function addSwitchInlineQueryCurrentChatButton($text,$query)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query_current_chat'=>$query];

        return $this;
    }

    public function addLoginUrlButton($text,$url)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE)
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query_current_chat'=>$query];

        return $this;
    }

    public function addPayButton($text)
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_INLINE;

        if($this->type !== self::TYPE_INLINE || !empty($this->keyboard))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'pay'=>true];

        return $this;
    }

    public function removeCustomKeyboard()
    {
        if(empty($this->keyboard))
            $this->type = self::TYPE_REMOVE_CUSTOM_KEYBOARD;

        return $this;
    }

    public function newRow(){
        if(isset($this->keyboard[$this->row]) and count($this->keyboard[$this->row]) > 0){
            $this->row++;
        }
        return $this;
    }

    public function flush(){
        $this->keyboard = [];
        $this->row = 0;
    }

    public function init()
    {
        if ($this->type != self::TYPE_REMOVE_CUSTOM_KEYBOARD && !$this->hasButton()) {
            return null;
        }

        if($this->type == self::TYPE_CUSTOM) {
            return $this->initCustomKeyboard();
        } else if($this->type == self::TYPE_INLINE) {
            return  $this->initInlineKeyboard();
        } else if($this->type == self::TYPE_REMOVE_CUSTOM_KEYBOARD) {
            return  $this->initRemoveCustomKeyboard();
        }

        return null;
    }

    private function initCustomKeyboard()
    {
        return json_encode([
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $this->resize ,
            'one_time_keyboard' => $this->onetime ,
        ]);
    }

    private function initInlineKeyboard()
    {
        return json_encode([
            'inline_keyboard' => $this->keyboard
        ]);
    }

    private function initRemoveCustomKeyboard(){
        return json_encode([
            'remove_keyboard' => true
        ]);
    }

    public function hasButton()
    {
        return isset($this->keyboard[0][0]);
    }

    public function get(){
        return $this->keyboard;
    }

    public function __toString()
    {
        return $this->init();
    }
}