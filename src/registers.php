<?php

/**
 * Registers Services and Providers in application
 * -----------------------------------------------
 */

use App\Repositories\{
    ProductRepositoryInterface,
    ProductRepository,
    CategoryRepositoryInterface,
    CategoryRepository,
    OrderRepositoryInterface,
    OrderRepository
};


return [
    [ProductRepositoryInterface::class, ProductRepository::class],
    [CategoryRepositoryInterface::class, CategoryRepository::class],
    [OrderRepositoryInterface::class, OrderRepository::class]
];