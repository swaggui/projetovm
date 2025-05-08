<?php
use Migrations\AbstractMigration;

class CreateTarefas extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('tarefas');
        $table->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('descricao', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('data_criacao', 'datetime', ['null' => false])
            ->addColumn('data_prevista', 'date', ['null' => false])
            ->addColumn('data_encerramento', 'datetime', ['null' => true])
            ->addColumn('situacao', 'string', ['limit' => 20, 'null' => false])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}
