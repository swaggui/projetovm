<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersAndTarefas extends AbstractMigration
{
    public function change(): void
    {
        // Cria a tabela de usuários (users)
        $this->table('users')
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('role', 'string', ['limit' => 20, 'default' => 'user', 'null' => false])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['email'], ['unique' => true])
            ->create();

        // Cria a tabela de tarefas (tarefas)
        $this->table('tarefas')
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('descricao', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('data_criacao', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('data_prevista', 'date', ['null' => false])
            ->addColumn('data_encerramento', 'date', ['null' => true])
            ->addColumn('situacao', 'enum', [
                'values' => ['pendente', 'em andamento', 'concluída'],
                'default' => 'pendente',
                'null' => false
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
