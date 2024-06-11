<?php

namespace App\Controllers;

use App\Models\{ Order, Product };
use App\Repositories\OrderRepositoryInterface;
use Packages\MVC\BaseController;
use Packages\Router\Http\Request;

class OrdersController extends BaseController
{
    public function __construct(
        private OrderRepositoryInterface $repository
    ){}

    public function makeOrder()
    {
        return $this->json([
            'data' => $this->repository->makeOrder()
        ], 201);
    }

    public function addProduct(Request $request)
    {
        $request->validate(['product_id','order_id']);
        
        $order = Order::find($request->order_id);
        $product = Product::find($request->product_id);

        return $this->json([
            'data' => $this->repository->addProduct($order, $product)
        ]);
    }

    public function getOrder(int $id)
    {
        $order = Order::find($id);

        return $this->json([
            'data' => $this->repository->getOrder($order)
        ]);
    }
}