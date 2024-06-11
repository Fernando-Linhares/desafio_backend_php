<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Products extends AbstractSeed
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
        $this->table('products')->insert([
            [
                "name" => "Notebook Acer Aspire",
                'category_id' => 1,
                "price" => 3000.00,
                
            ],
            [
                "name" => "Notebook Dell Inspiron",
                "price" => 3500.00,
                'category_id' => 1,
               
            ],
            [
                "name" => "Notebook Lenovo Ideapad",
                "price" => 3200.00,
                'category_id' => 1,
              
            ],
            [
                "name" => "Notebook HP Pavilion",
                "price" => 3700.00,
                'category_id' => 1,
            ],
            [
                "name" => "Notebook Asus ZenBook",
                "price" => 4000.00,
                'category_id' => 1,
            ],
            [
                "name" => "Smart Phone iPhone 13",
                "price" => 5000.00,
                'category_id' => 2,
            ],
            [
                "name" => "Smart Phone Samsung Galaxy S21",
                "price" => 4500.00,
                'category_id' => 2,
            ],
            [
                "name" => "Smart Phone OnePlus 9",
                "price" => 4000.00,
                'category_id' => 2,
            ],
            [
                "name" => "Smart Phone Google Pixel 6",
                "price" => 4200.00,
                'category_id' => 2,
            ],
            [
                "name" => "Smart Phone Xiaomi Mi 11",
                "price" => 3800.00,
                'category_id' => 2,
            ],
            [
                "name" => "Refrigerador Brastemp",
                "price" => 2500.00,
                'category_id' => 3,
            ],
            [
                "name" => "Máquina de Lavar Samsung",
                "price" => 2000.00,
                'category_id' => 3,
            ],
            [
                "name" => "Micro-ondas Panasonic",
                "price" => 600.00,
                'category_id' => 3,
            ],
            [
                "name" => "Fogão Electrolux",
                "price" => 1500.00,
                'category_id' => 3,
            ],
            [
                "name" => "Aspirador de Pó Philips",
                "price" => 800.00,
                'category_id' => 3,
            ]
        ])
        ->saveData();
    }
}
