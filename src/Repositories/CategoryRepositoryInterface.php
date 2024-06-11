<?php

namespace App\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll(): array;

    public function find(int $id): Category;

    public function update(int $id, $data): Category;

    public function delete(int $id): bool;

    public function create(array $data): Category;
}