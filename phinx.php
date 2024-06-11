<?php

use Packages\Dotenv\Dotenv;

$dotenv = new Dotenv;

$dotenv->load('.env');

if($dotenv->DB_DATABASE == 'sqlite'){ 
    return [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => $dotenv->DB_DATABASE,
                'name' => $dotenv->DB_HOST,
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => $dotenv->DB_DATABASE,
                'name' => $dotenv->DB_HOST,
            ],
            'testing' => [
                'adapter' => 'sqlite',
                'name' => 'db',
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
}

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => $dotenv->DB_DATABASE,
            'host' => $dotenv->DB_HOST,
            'name' => $dotenv->DB_NAME,
            'user' => $dotenv->DB_USERNAME,
            'pass' => $dotenv->DB_PASSWORD,
            'port' => $dotenv->DB_PORT,
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => $dotenv->DB_DATABASE,
            'host' => $dotenv->DB_HOST,
            'name' => $dotenv->DB_NAME,
            'user' => $dotenv->DB_USERNAME,
            'pass' => $dotenv->DB_PASSWORD,
            'port' => $dotenv->DB_PORT,
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => 'db',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
