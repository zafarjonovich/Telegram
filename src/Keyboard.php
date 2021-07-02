<?php


namespace zafarjonovich\Telegram;


class Keyboard
{
    private $keyboard = [];

    private $row = 0;

    protected $type;

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

    public function addCustomButton($text)
    {
        if(empty($this->keyboard))
            $this->type = 'text';

        if(!in_array($this->type,['text']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text];

        return $this;
    }

    public function addRequestContactButton($text)
    {
        if(empty($this->keyboard))
            $this->type = 'text';

        if(!in_array($this->type,['text']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'request_contact'=>true];

        return $this;
    }

    public function addRequestLocationButton($text)
    {
        if(empty($this->keyboard))
            $this->type = 'text';

        if(!in_array($this->type,['text']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'request_location'=>true];

        return $this;
    }

    public function addCallbackDataButton($text,$callback_data)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'callback_data'=>$callback_data];

        return $this;
    }

    public function addUrlButton($text,$url)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'url'=>$url];

        return $this;
    }

    public function addSwitchInlineQueryButton($text,$query)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query'=>$query];

        return $this;
    }

    public function addSwitchInlineQueryCurrentChatButton($text,$query)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query_current_chat'=>$query];

        return $this;
    }

    public function addLoginUrlButton($text,$url)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'switch_inline_query_current_chat'=>$query];

        return $this;
    }

    public function addPayButton($text)
    {
        if(empty($this->keyboard))
            $this->type = 'inline';

        if(!in_array($this->type,['inline']) or !empty($this->keyboard))
            return $this;

        $this->keyboard[$this->row][] = ['text'=>$text,'pay'=>true];

        return $this;
    }

    public function newRow(){
        $this->row++;
        return $this;
    }

    public function flush(){
        $this->keyboard = [];
        $this->row = 0;
    }

    public function initCustomKeyboard($resize = true,$one_time = false)
    {
        return json_encode([
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $resize ,
            'one_time_keyboard' => $one_time ,
        ]);
    }

    public function initInlineKeyboard()
    {
        return json_encode([
            'inline_keyboard' => $this->keyboard
        ]);
    }

    public function initRemoveCustomKeyboard(){
        return json_encode([
            'remove_keyboard' => true
        ]);
    }

    public function get(){
        return $this->keyboard;
    }
}