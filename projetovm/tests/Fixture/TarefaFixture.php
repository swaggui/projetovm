<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TarefaFixture
 */
class TarefaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'tarefa';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'descricao' => 'Lorem ipsum dolor sit amet',
                'data_criacao' => '2025-03-27 23:21:02',
                'data_prevista' => '2025-03-27',
                'data_encerramento' => '2025-03-27',
                'situacao' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
