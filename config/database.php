<?php

use App\Models\Order;
use Packages\Dotenv\Dotenv;

$dotenv = new Dotenv();

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

if($dotenv->APP_ENV == 'testing') {
    $capsule->addConnection([
        'driver' => 'sqlite',
        'database' => '../db.sqlite3',
    ]);

    $capsule->setAsGlobal();

    $capsule->bootEloquent();
    
    return;
}

if($dotenv->DB_DATABASE == 'sqlite') {

    $capsule->addConnection([
        'driver' => 'sqlite',
        'database' => '../'. $dotenv->DB_HOST .'.sqlite3',
        'charset' => 'utf8',
    ]);

    $capsule->setAsGlobal();

    $capsule->bootEloquent();
    
    return;
}

$capsule->addConnection([
    'driver' => $dotenv->DB_DATABASE,
    'host' => $dotenv->DB_HOST,
    'database' => $dotenv->DB_NAME,
    'username' => $dotenv->DB_USERNAME,
    'password' => $dotenv->DB_PASSWORD,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();