<?php


namespace zafarjonovich\Telegram;


class Keyboard
{
    const REQUEST_CONTACT = 'REQUEST_CONTACT';
    const REQUEST_LOCATION = 'REQUEST_LOCATION';

    private $keyboard = [];

    private $row = 0;

    public function addButton($text,$parameter = null){
        $button = ['text'=>$text];

        if(!is_null($parameter)){
            if($parameter == Keyboard::REQUEST_CONTACT){
                $button['request_contact'] = true;
            }else if($parameter == Keyboard::REQUEST_LOCATION){
                $button['request_location'] = true;
            }else if(is_string($parameter) and filter_var($parameter, FILTER_VALIDATE_URL) !== false){
                $button['url'] = $parameter;
            }else{
                $button['callback_data'] = $parameter;
            }
        }

        $this->keyboard[$this->row][] = $button;

        return $this;
    }

    public function newRow(){
        $this->row++;
        return $this;
    }

    /**
     *  $keyboard = new Keyboard;
     *
     * $items = [1,2,3];
     *
     * $result = $keyboard->createWithPattern($items);
     *
     * ```php
     *  [
     *    [['text'=>1]],
     *    [['text'=>2]],
     *    [['text'=>3]]
     *  ]
     * ```
     *
     *
     * $items = [1,2,3,4,5,6];
     *
     * $result = $keyboard->createWithPattern($items,2);
     *
     * ```php
     *  [
     *    [['text'=>1],['text'=>2]]],
     *    [['text'=>3],['text'=>4]],
     *    [['text'=>5],['text'=>6]]
     *  ]
     * ```
     *
     * $items = [1,2,3,4,5,6,7,8,9];
     *
     * $result = $keyboard->createWithPattern($items,[4,2,3]);
     *
     * ```php
     *  [
     *    [['text'=>1],['text'=>2],['text'=>3],['text'=>4]],
     *    [['text'=>5],['text'=>6]],
     *    [['text'=>7],['text'=>8],['text'=>9]]
     *  ]
     * ```
     *
     *
     *
     * @param $items
     * @param null $pattern
     * @return $this
     */

    public function createWithPattern($items,$pattern = null){

        if(is_null($pattern)){
            $pattern = 1;
        }

        if(is_numeric($pattern)){
            $pattern = array_fill(0,(ceil(count($items)/$pattern)),$pattern);
        }

        //var_dump(array_sum($pattern) >= count($items));die;

        if(is_array($pattern) and array_sum($pattern) >= count($items)){

            for($i=0;$i<count($items);$i++){

                $text = $items[$i];
                $parameter = null;

                if(is_array($items[$i])){
                    $text = $items[$i][1];
                    $parameter = $items[$i][0];
                }

                $this->addButton($text,$parameter);

                if(count($this->keyboard[$this->row]) == $pattern[$this->row])
                    $this->newRow();
            }

        }

        return $this;
    }

    public function flush(){
        $this->keyboard = [];
        $this->row = 0;
    }

    public function get(){
        return $this->keyboard;
    }
}