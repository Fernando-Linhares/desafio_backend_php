<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Categories extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $this->table('categories')->insert([
            [
                "name" => "Notebooks",
                'fee' => 6
            ],
            [
                "name" => "Smart Phones",
                'fee' => 8
            ],
            [
                "name" => "Eletrodomésticos",
                'fee' => 10
            ]
        ])
        ->saveData();
    }
}
