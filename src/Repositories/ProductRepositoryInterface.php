<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();

    public function find(int $id);

    public function update(int $id, $data): ?Product;

    public function delete(int $id): bool;

    public function create(array $data): Product;
}