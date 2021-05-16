# Telegram bot handler

Assalomu aleykum. These components will help you work with the telegram bot api in your own project. It is very simple to use.

-----
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require zafarjonovich/telegram
```

or add

```
"zafarjonovich/telegram": "*"
```

to the require section of your `composer.json` file.

------
## Usage

All methods in the [Telegram bot api](https://core.telegram.org/bots/api) can be used as follows

```php

<?php

require_once 'vendor/autoload.php';

$bot_token = '1111111:AAABBBBCCCDDDDEEEERRRRTTTT';

$telegram = new \zafarjonovich\Telegram\BotApi($bot_token);

$telegram->query('sendMessage',[
    'chat_id' => 1122,
    'text' => 'Hello world!'
]);

$telegram->query('sendPhoto',[
    'chat_id' => 1122,
    'photo' => 'photo_url'
]);

?>

```

<br>

Several telegram methods have been written. The required parameters in the bot api method are given as parameters in the handler method, and the extensions are added to the optional fields.

##### Written methods
sendMessage,deleteMessage,getChatMember,getChat,exportChatInviteLink,editMessageText,answerCallback,forwardMessage,sendPhoto,sendVideo,sendContact,sendDocument,sendLocation,getMe,getWebHookInfo,getUpdates
##### Usage written methods
```php
<?php

require_once 'vendor/autoload.php';

$bot_token = '1111111:AAABBBBCCCDDDDEEEERRRRTTTT';

$telegram = new \zafarjonovich\Telegram\BotApi($bot_token);

$telegram->sendMessage($chat_id,$text);

$telegram->sendMessage($chat_id,$text,[
    'parse_mode' => 'markdown'
]);

$telegram->sendPhoto($chat_id,$photo,[
    'caption' => 'Hello world!'
])
?>
```