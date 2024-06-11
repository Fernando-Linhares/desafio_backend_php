<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrderProductsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->table('order_products')
            ->addColumn('product_id', 'integer')
            ->addColumn('order_id', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->create();
    }

    public function down(): void
    {
        $this->table('DROP TABLE order_products');
    }
}
