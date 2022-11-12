<?php

namespace LearnPhpMvc\Config;

class Url
{
    static function BaseUrl(): string
    {
        $url = "http://localhost/mmagym/src/public/";
        return $url;
    }

    static function BaseApi() : string{
        $url = "http://192.168.192.156/mmagym/src/public/";
        // $url = "http//localhost:8080";
        return $url;
    }
}
