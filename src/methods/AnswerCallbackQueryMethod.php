<?php


namespace zafarjonovich\Telegram\methods;


use zafarjonovich\Telegram\base\Method;

class AnswerCallbackQueryMethod extends Method
{
    protected $method = 'answerCallbackQuery';

    public function __construct($callback_query_id,$text,bool $show_alert = false,array $options = [])
    {
        $this->options = $this->merge(
            compact('callback_query_id','text','show_alert'),
            $options
        );
    }
}