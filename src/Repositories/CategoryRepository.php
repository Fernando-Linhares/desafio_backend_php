<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): array
    {
        return Category::all()->toArray();
    }

    public function find(int $id): Category
    {
        return Category::find($id);
    }

    public function update(int $id, $data): Category
    {
        $cateogory = Category::find($id);

        return $cateogory->update($data) ? $cateogory : $cateogory;
    }

    public function delete(int $id): bool
    {
        return Category::find($id)->delete();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }
}