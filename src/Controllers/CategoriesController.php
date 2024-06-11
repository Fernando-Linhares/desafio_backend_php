<?php

namespace App\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Packages\MVC\BaseController;
use Packages\Router\Http\Request;

class CategoriesController extends BaseController
{
    public function __construct(
        private CategoryRepositoryInterface $repository
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
        ],201);
    }

    public function update(int $id, Request $request)
    {
        return $this->json([
            'data' => $this->repository->update($id, $request->all())
        ],201);
    }

    public function delete($id)
    {
        if($this->repository->delete($id))
            return $this->json([
                'data' => 'category deleted successfully'
            ]);

        return $this->json([
            'error' => 'delete category fail'
        ], 500);
    }
}