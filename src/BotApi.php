<?php

namespace zafarjonovich\Telegram;

use zafarjonovich\Telegram\update\Update;

/**
 * Class BotApi
 * @property $message
 * @property $callback_query
 * @property $inline_query
 * @property int $chat_id
 * @property int $from_id
 * @property int $message_id
 * @property mixed|Update $update
 */

class BotApi{

    public $update = null;
    public $message = null;
    public $callback_query = null;
    public $inline_query = null;

    public $from_id = null;
    public $chat_id = null;
    public $message_id = null;

    private $token;

    public function __construct($token = null){
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function removeCustomKeyboard(){
        return json_encode([
            'remove_keyboard' => true
        ]);
    }

    public function makeCustomKeyboard($buttons,$resize = true,$one_time = true) {
        return json_encode([
            'keyboard' => $buttons,
            'resize_keyboard' => $resize ,
            'one_time_keyboard' => $one_time ,
        ]);
    }

    public function makeInlineKeyboard($buttons) {
        return json_encode([
            'inline_keyboard' => $buttons
        ]);
    }

    public function deleteMessage($chat_id,$message_id){
        $required_fields = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ];
        return $this->query('deleteMessage',$required_fields);
    }

    public function getChatAdministrators($chat_id)
    {
        $required_fields = [
            'chat_id' => $chat_id
        ];
        return $this->query('getChatAdministrators',$required_fields);
    }

    public function getChatMember($chat_id,$user_id)
    {
        $required_fields = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];
        return $this->query('getChatMember',$required_fields);
    }

    public function setMessageReaction($chat_id, $message_id, $optional_fields = [])
    {
        $required_fields = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('setMessageReaction',$params);
    }

    public function getFile($file_id)
    {
        $required_fields = [
            'file_id' => $file_id,
        ];
        return $this->query('getFile',$required_fields);
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

    public function editMessageReplyMarkup($chat_id,$message_id,$reply_markup,$optional_fields = null) {
        $required_fields = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'reply_markup' => $reply_markup,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('editMessageReplyMarkup',$params);
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

    public function sendMediaGroup($chat_id,$media,$optional_fields = null) {
        $required_fields = [
            'chat_id' => $chat_id,
            'media' => $media,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendMediaGroup',$params);
    }

    public function sendChatAction($chat_id,$action) {
        $required_fields = [
            'chat_id' => $chat_id,
            'action' => $action,
        ];

        $params = $this->merge_fields($required_fields);
        return $this->query('sendChatAction',$params);
    }

    public function sendSticker($chat_id,$sticker,$optional_fields = null) {
        $required_fields = [
            'chat_id' => $chat_id,
            'sticker' => $sticker,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendSticker',$params);
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

    public function sendVideoNote($chat_id,$video_note,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'video_note' => $video_note,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendVideoNote',$params);
    }

    public function sendAnimation($chat_id,$animation,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'animation' => $animation,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendAnimation',$params);
    }

    public function sendAudio($chat_id,$audio,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'audio' => $audio,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendVideo',$params);
    }

    public function sendVoice($chat_id,$voice,$optional_fields = []){
        $required_fields = [
            'chat_id' => $chat_id,
            'voice' => $voice,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendVoice',$params);
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

    public function kickChatMember($chat_id, $user_id, $optional_fields = null)
    {
        $required_fields = [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ];

        $params = $this->merge_fields($required_fields,$optional_fields);

        return $this->query('kickChatMember', $params);
    }

    public function createChatInviteLink($chat_id, $options = [])
    {
        $required_fields = [
            'chat_id' => $chat_id,
        ];
        $options_fields = array_merge($required_fields, $options);
        return $this->query('createChatInviteLink', $options_fields);
    }

    public function revokeChatInviteLink($chat_id, $invite_link)
    {
        $required_fields = [
            'chat_id' => $chat_id,
            'invite_link' => $invite_link,
        ];
        return $this->query('revokeChatInviteLink', $required_fields);
    }

    public function sendDocument($chat_id,$document,$optional_fields = null){
        $required_fields = [
            'chat_id' => $chat_id,
            'document' => $document,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('sendDocument',$params);
    }

    public function answerInlineQuery($inline_query_id,$results,$optional_fields = null){
        $required_fields = [
            'inline_query_id' => $inline_query_id,
            'results' => $results,
        ];
        $params = $this->merge_fields($required_fields,$optional_fields);
        return $this->query('answerInlineQuery',$params);
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

        if($update instanceof Update){
            $update = $update->get();
        }

        if(isset($update['message'])) {
            $this->message = $update['message'];
            $this->chat_id = $this->message['chat']['id'] ?? null;
            $this->from_id = $this->message['from']['id'] ?? null;
            $this->message_id = $this->message['message_id'] ?? null;
        }elseif(isset($update['callback_query'])) {
            $this->callback_query = $update['callback_query'];
            $this->message_id = $update['callback_query']['message']['message_id'] ?? null;
            $this->from_id = $update['callback_query']['from']['id'] ?? null;
            $this->chat_id = $update['callback_query']['message']['chat']['id'] ?? null;
        }elseif(isset($update['inline_query'])) {
            $this->inline_query = $update['inline_query'];
            //$this->chat_id = $update['inline_query']['chat']['id'];
            $this->from_id = $update['inline_query']['from']['id'] ?? null;
        }
    }

    private function merge_fields($required_fields,$optional_fields = null){
        return array_merge($required_fields,(array)$optional_fields);
    }

    public function query($method, $data =[]){

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