<?php

namespace App\Repositories;

use App\Models\{ Order, Product };

interface OrderRepositoryInterface
{
    public function getAll(): array;

    public function find(int $id): Order;

    public function update(int $id, $data): Order;

    public function delete(int $id): bool;

    public function create(array $data): Order;

    public function addProduct(Order $order, Product $product);

    public function getOrder(Order $order): array;

    public function makeOrder(): Order;
}