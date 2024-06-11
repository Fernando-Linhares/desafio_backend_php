<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCategoriesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->table('categories')
            ->addColumn('name', 'string')
            ->addColumn('deleted_at', 'datetime', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('fee', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
        ->create();
    }

    public function down(): void
    {
        $this->execute('DROP TABLE categories');
    }
}
