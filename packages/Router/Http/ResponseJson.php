<?php

namespace Packages\Router\Http;

class ResponseJson extends Response
{
    public function __construct()
    {
        if(empty(self::$headers)) {
           $this->addHeaders(['Content-Type' => 'application/json']);
        }
    }

    public function render()
    {
        if(is_string(self::$content))
            return self::$content;

        if(is_array(self::$content))
            return json_encode(self::$content);

        if(is_object(self::$content) && method_exists(self::$content, 'toArray'))
            return json_encode(self::$content->toArray());

        if(is_object(self::$content) && method_exists(self::$content, 'serialize'))
            return json_encode(self::$content->serialize());

        if(is_object(self::$content))
            return json_encode(self::$content);

        return '';
    }
}