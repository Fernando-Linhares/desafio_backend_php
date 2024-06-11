<?php

namespace App\Repositories;

use App\Models\{ Order, OrderProduct, Product };
use Packages\Currency\Currency;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(): array
    {
        return Order::all()->toArray();
    }

    public function find(int $id): Order
    {
        return Order::find($id);
    }

    public function update(int $id, $data): Order
    {
        $cateogory = Order::find($id);

        return $cateogory->update($data) ? $cateogory : $cateogory;
    }

    public function delete(int $id): bool
    {
        return Order::find($id)->delete();
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function makeOrder(): Order
    {
        return Order::create([]);
    }

    public function addProduct(Order $order, Product $product)
    {
        
        OrderProduct::create([
            'product_id' => $product->id,
            'order_id' => $order->id
        ]);

        return [
            'product' => $product,
            'order' => $order
        ];
    }

    public function getOrder(Order $order): array
    {
        return [
            'fee' => $this->sumFees($order),
            'net_value' => $this->sumNetValues($order),
            'gross_value' => $this->sumGrossValue($order),
            'amount' => $order->products->count()
        ];
    }

    private function sumFees(Order $order)
    {
        $value = $order->products->count() > 0
            ? $order
                ->products
                ->reduce(fn($amount=0, $product) => $amount + $product->fee)
            : '0.00';

        return Currency::brl($value);
    }

    private function sumNetValues(Order $order)
    {
        $value = $order->products->count() > 0
            ? $order
                ->products
                ->reduce(fn($amount=0, $product) => $amount + $product->net_value)
            : '0.00';

        return Currency::brl($value);
    }

    private function sumGrossValue(Order $order)
    {
        $value = $order->products->count() > 0
            ? $order
                ->products
                ->reduce(fn($amount=0, $product) => $amount + $product->price)
            : '0.00';
    
        return Currency::brl($value);
    }
}