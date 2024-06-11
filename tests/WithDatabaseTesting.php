<?php

namespace Tests;

use Illuminate\Database\Capsule\Manager as Capsule;

trait WithDatabaseTesting
{
    public function database()
    {
        $capsule = new Capsule;

        exec("php vendor/bin/phinx migrate -e testing");
        exec("php vendor/bin/phinx seed:run -e testing");

        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => 'db.sqlite3',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}
