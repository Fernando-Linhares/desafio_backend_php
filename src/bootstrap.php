<?php

include_once '../vendor/autoload.php';

use Packages\Dotenv\Dotenv;

$dotenv = new Dotenv;

$dotenv->load('../.env');

include_once '../config/database.php';

include_once '../config/app.php';
