<?php

namespace zafarjonovich\Telegram\effects;

use zafarjonovich\Telegram\BotApi;

class MessageProgress
{

    /**
     * @var array $progresses
     *
     * ```php
     *
     * $progresses = [[0,1],[20,1],[50,1],[70,2]];
     *
     * ```
     */

    public $progresses = [];

    public $chat_id;

    public $api;

    public $total_length = 12;

    public $done = 0;

    public $progresses_char = "█";

    public $unprogresses_char = "▒";

    public $show_procent = true;

    public $called_results = [];

    public function __construct(BotApi $api,$progresses,$chat_id)
    {
        $this->progresses = $progresses;
        $this->api = $api;
        $this->chat_id = $chat_id;
    }

    public function createProgressText($perc)
    {
        $width = $this->total_length;
        $bar = round(($width * $perc) / 100);
        return str_repeat($this->progresses_char, $bar).str_repeat($this->unprogresses_char, $width-$bar);
    }

    public function run()
    {
        if(!empty($this->progresses))
        {

            $message_id = null;

            foreach ($this->progresses as $progress)
            {
                $perc = $progress[0];
                $text = $this->createProgressText($perc);

                if($this->show_procent)
                {
                    $text .= ' '.$perc.'%';
                }

                if($message_id === null)
                {
                    $message_id = $this->api->sendMessage($this->chat_id,$text)['result']['message_id'];
                }else{
                    $message_id = $this->api->editMessageText($this->chat_id,$message_id,$text)['result']['message_id'];
                }

                if(isset($progress[1]) and is_numeric($progress[1]) and $progress[1] > 0)
                    sleep($progress[1]);

                if(isset($progress[2]) and $progress[2] instanceof \Closure)
                {
                    $this->called_results[] = $progress[2]();
                }
            }

            $this->api->deleteMessage($this->chat_id,$message_id);
        }
    }
}