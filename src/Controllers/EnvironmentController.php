<?php

namespace App\Controllers;

use Packages\Dotenv\Dotenv;
use Packages\MVC\BaseController;

class EnvironmentController extends BaseController
{
    public function index(Dotenv $dotenv)
    {
        return $this->json([
            'app' =>[
                'name' => $dotenv->APP_NAME,
                'version' => $dotenv->APP_VERSION,
                'env' => $dotenv->APP_ENV,
            ]
        ]);
    }
}