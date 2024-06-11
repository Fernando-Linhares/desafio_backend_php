<?php

namespace App\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Packages\MVC\BaseController;
use Packages\Router\Http\Request;

class ProductsController extends BaseController
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ){}

    public function index()
    {
        return $this->json([
            'data' => $this->repository->getAll()
        ]);
    }

    public function show(int $id)
    {
        return $this->json([
            'data' => $this->repository->find($id)
        ]);
    }

    public function store(Request $request)
    {
        return $this->json([
            'data' => $this->repository->create($request->all())
        ], 201);
    }

    public function update(int $id, Request $request)
    {
        return $this->json([
            'data' => $this->repository->update($id, $request->all())
        ], 201);
    }

    public function delete(int $id)
    {
        if($this->repository->delete($id))
            return $this->json([
                'data' => 'product deleted successfully'
            ]);

        return $this->json([
            'error' => 'delete product fail'
        ], 500);
    }
}