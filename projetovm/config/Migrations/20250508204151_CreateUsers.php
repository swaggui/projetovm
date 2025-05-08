<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime', ['null' => false])
            ->addColumn('modified', 'datetime', ['null' => false])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
