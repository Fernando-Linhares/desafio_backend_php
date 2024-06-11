<?php

namespace Packages\Router\Http;

use Packages\Exceptions\BadRequestException;

class Request
{
    private static $params = [];

    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET))
            self::$params = array_merge(self::$params, $_GET);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
            self::$params = array_merge(self::$params, $_POST);

        if($_SERVER['REQUEST_METHOD'] == 'PUT' OR $_SERVER['REQUEST_METHOD'] == 'PATCH' OR $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $inputs = file_get_contents("php://input");
            $inputs = explode('&', $inputs);

            $form = [];

            foreach($inputs as $item) {
                [$key, $value] = explode('=', $item);
                $form[$key] = urldecode($value);
            }

            self::$params = array_merge(self::$params, $form);
        }
    }

    public function hasParams()
    {
        return !empty(self::$params);
    }

    public function getParams()
    {
        return self::$params;
    }

    public function setParams(array $params)
    {
        self::$params = array_merge(self::$params, $params);
    }

    public function all()
    {
        return self::$params;
    }

    public function __get($name)
    {
        if(array_key_exists($name, self::$params))
            return self::$params[$name];

        return '';
    }

    public function validate(array $fields)
    {
        foreach($fields as $field) {
            if(!array_key_exists($field, self::$params))
                throw new BadRequestException("Bad request param {$field} not found");
        }
    }
}