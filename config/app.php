<?php

use Packages\Dotenv\Dotenv;

$dotenv = new Dotenv();

define('APP_NAME', $dotenv->APP_NAME ?? 'STORE');

define('APP_VERSION', $dotenv->APP_VERSION ?? '1.0.0');

define('APP_ENV', $dotenv->APP_ENV ?? 'development');
