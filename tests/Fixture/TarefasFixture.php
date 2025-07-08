<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TarefasFixture extends TestFixture
{
    public $import = ['table' => 'tarefas'];

    public array $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'descricao' => 'Tarefa de teste 1',
            'data_criacao' => '2025-05-01 10:00:00',
            'data_prevista' => '2025-05-10',
            'data_encerramento' => null,
            'situacao' => 'pendente',
        ],
        [
            'id' => 2,
            'user_id' => 1,
            'descricao' => 'Tarefa de teste 2',
            'data_criacao' => '2025-05-02 12:00:00',
            'data_prevista' => '2025-05-15',
            'data_encerramento' => '2025-05-14',
            'situacao' => 'concluída',
        ],
    ];
}
