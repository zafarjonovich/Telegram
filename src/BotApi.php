<?php

namespace zafarjonovich\Telegram;

/**
 * Class BotApi
 * @package app\telegram
 * @property $message
 * @property $callback_query
 * @property int $chat_id
 * @property int $message_id
 * @property mixed $update
 */

class BotApi{

    public $update = null;
    public $message = null;
    public $callback_query = null;

    public $chat_id = null;
    public $message_id = null;

    private $token;

    public function __construct($token = null){
        $this->token = $token;
    }

    public function removeCustomKeyboard(){
        return [
            'remove_keyboard' => true
        ];
    }

    public function makeCustomKeyboard($buttons,$resize = true,$one_time = true) {
        return [
            'keyboard' => $buttons,
            'resize_keyboard' => $resize ,
            'one_time_keyboard' => $one_time ,
        ];
    }

    public function makeInlineKeyboard($buttons) {
        return [
            'inline_keyboard' => $buttons
        ];
    }

    public function deleteMessage($chat_id,$message_id){
        $required_fields = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ];
        return $this->query('deleteMessage',$required_fields);
    }

    public function getChatMember($chat_id,$user_id)
    {
        $required_fields = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];
        return $this->query('getChatMember',$required_fields);
    }

    public function getChat($chat_id)
    {
        $required_fields = [
            'chat_id' => $chat_id,
        ];
        return $this->query('getChat',$required_fields);
    }

    public function exportChatInviteLink($chat_id)
    {
        $required_fields = [
            'chat_id' => $chat_id,
        ];
        return $this->query('exportChatInviteLink',$required_fields);
    }

    public function deleteCurrentMessage()
    {
        return $this->deleteMessage($this->chat_id,$this->message_id);
    }

    public function editMessageText($chat_id,$message_id,$text,$optional_fields = null) {
        $required_fields = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => $text,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('editMessageText',$params);
    }

    public function answerCallback($callback_query_id,$text,$show_alert = true,$optional_fields = null) {
        $required_fields = [
            'callback_query_id' => $callback_query_id,
            'text' => $text,
            'show_alert' => $show_alert
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('answerCallbackQuery',$params);
    }

    public function sendMessage($chat_id,$text,$optional_fields = null) {
        $required_fields = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendMessage',$params);
    }

    public function forwardMessage($chat_id,$from_chat_id,$message_id,$optional_fields = null){
        $required_fields = [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('forwardMessage',$params);
    }

    public function sendPhoto($chat_id,$photo,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'photo' => $photo,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendPhoto',$params);
    }

    public function sendVideo($chat_id,$video,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'video' => $video,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendVideo',$params);
    }

    public function sendContact($chat_id,$phone_number,$first_name,$optional_fields = null){
        $required_fields = [
            'chat_id' => $chat_id,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendContact',$params);
    }

    public function sendDocument($chat_id,$document,$optional_fields = null){
        $required_fields = [
            'chat_id' => $chat_id,
            'document' => $document,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendDocument',$params);
    }

    public function sendLocation($chat_id,$latitude,$longitude,$optional_fields = null){
        $required_fields = [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendLocation', $params);
    }

    public function getMe(){
        $params = [];
        return $this->query('getMe',$params);
    }

    public function getWebHookInfo(){
        return $this->query('getwebhookInfo',[]);
    }

    public function getUpdates($options = []){
        return $this->query('getUpdates',$options);
    }

    public function getWebHookUpdate(){
        return json_decode(file_get_contents('php://input'),true);
    }

    public function invokeUpdates()
    {
        $update = $this->update;
        if(isset($update['message']))
        {
            $this->message = $update['message'];
            $this->chat_id = $this->message['from']['id'];
            $this->message_id = $this->message['message_id'];
        }elseif(isset($update['callback_query'])) {
            $this->callback_query = $update['callback_query'];
            $this->message_id = $update['callback_query']['message']['message_id'];
            $this->chat_id = $update['callback_query']['from']['id'];
        }
    }

    private function merge_fields($required_fields,$optional_fields = null){
        if(is_array($optional_fields)){
            return array_merge($required_fields,$optional_fields);
        }else{
            return $required_fields;
        }
    }

    public function query($method, $data =[]){

        array_walk($data,function (&$value){
            if(is_array($value)){
                $value = json_encode($value);
            }
        });

        $url = "https://api.telegram.org/bot". $this->token ."/".$method;
        $ch = curl_init();


        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        $response = curl_exec($ch);

        $result = json_decode($response, true );

        if (!$result) {
            $result = [
                'ok' => false,
                'error' => 'Invalid JSON',
                'response' => $response,
            ];
        }
        curl_close($ch);
        return $result;
    }
}