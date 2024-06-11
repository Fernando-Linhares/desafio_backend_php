<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProductsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->table('products')
            ->addColumn('name', 'string')
            ->addColumn('price', 'decimal')
            ->addColumn('category_id', 'integer')
            ->addColumn('deleted_at', 'datetime', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->create();
    }

    public function down(): void
    {
        $this->execute('DROP TABLE products');
    }
}
