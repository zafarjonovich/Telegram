<?php


namespace zafarjonovich\Telegram\update\objects;


use zafarjonovich\Telegram\update\Objects;


class From extends Objects
{
    public function getId()
    {
        return $this->data['id'];
    }

    public function isBot()
    {
        return $this->data['is_bot'];
    }

    public function hasUsername()
    {
        return isset($this->data['username']);
    }

    public function getUsername()
    {
        return $this->data['username'];
    }

    public function getFirstname()
    {
        return $this->data['first_name'];
    }

    public function hasLastname()
    {
        return isset($this->data['last_name']);
    }

    public function getLastname()
    {
        return $this->data['last_name'];
    }

    public function hasLanguageCode()
    {
        return isset($this->data['language_code']);
    }

    public function getLanguageCode()
    {
        return $this->data['language_code'];
    }

    public function getStatus()
    {
        return $this->data['status'];
    }

    public function getBio()
    {
        static $bio = null;

        if ($bio === null) {
            if (!$this->hasUsername()) {
                $bio = '';
                return $bio;
            }

            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_USERAGENT      => "spider",
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120,
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_SSL_VERIFYPEER => false
            );

            $ch      = curl_init('https://t.me/'.$this->getUsername());
            curl_setopt_array( $ch, $options );
            $content = curl_exec( $ch );
            $err     = curl_errno( $ch );
            $errmsg  = curl_error( $ch );
            $header  = curl_getinfo( $ch );
            curl_close( $ch );

            $has = preg_match('/<div class="tgme_page_description ">([^<]+)<\/div>/i', $content, $matches);

            $bio = $matches[1] ?? null;
        }
        return $bio;
    }
}