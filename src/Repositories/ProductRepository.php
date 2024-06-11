<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::orderByDesc('id')->get();
    }

    public function find(int $id)
    {
        return Product::find($id);
    }

    public function update(int $id, $data): ?Product
    {
        $product = Product::find($id);

        return $product->update($data) ? $product : null;
    }

    public function delete(int $id): bool
    {
        return Product::find($id)->delete($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }
}