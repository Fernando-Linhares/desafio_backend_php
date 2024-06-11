<?php

namespace Packages\Router\Http;

use Packages\Exceptions\BadRequestException;

class RequestJson extends Request
{
    private static $params = [];

    public function __construct()
    {
        $inputs = file_get_contents("php://input");

        if(!json_validate($inputs)) {
            throw new BadRequestException("Request is not json format");
        }

        $inputs = json_decode($inputs);
        $inputs = (array) $inputs;
        self::$params = array_merge(self::$params, $inputs);
    }

    public function all()
    {
        return self::$params;
    }
}