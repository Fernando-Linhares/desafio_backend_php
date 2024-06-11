<?php

namespace Packages\MVC;

use Packages\Router\Http\ResponseJson;

abstract class BaseController
{
    public function json($content, int $status=200, array $headers=[])
    {
        $response = new ResponseJson();

        $response->setStatus($status);

        if(!empty($headers))
            $response->setHeaders($headers);

        return $content;
    }
}