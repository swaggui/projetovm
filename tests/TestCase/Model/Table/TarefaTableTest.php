<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TarefasTable;
use Cake\TestSuite\TestCase;

class TarefaTableTest extends TestCase
{
    protected array $fixtures = ['app.Tarefas', 'app.Users'];

    protected $Tarefas;

    public function setUp(): void
    {
        parent::setUp();
        $this->Tarefas = $this->getTableLocator()->get('Tarefas');
    }

    public function tearDown(): void
    {
        unset($this->Tarefas);
        parent::tearDown();
    }

    public function testValidationDescricaoRequired(): void
    {
        $tarefa = $this->Tarefas->newEntity(['user_id' => 1, 'data_prevista' => '2025-05-10']);
        $this->assertFalse($this->Tarefas->save($tarefa));
        $this->assertArrayHasKey('descricao', $tarefa->getErrors());
    }

    public function testValidationDataPrevistaRequired(): void
    {
        $tarefa = $this->Tarefas->newEntity(['user_id' => 1, 'descricao' => 'Tarefa sem data']);
        $this->assertFalse($this->Tarefas->save($tarefa));
        $this->assertArrayHasKey('data_prevista', $tarefa->getErrors());
    }

    public function testCreateValidTarefa(): void
    {
        $tarefa = $this->Tarefas->newEntity([
            'user_id' => 1,
            'descricao' => 'Nova tarefa super válida',
            'data_prevista' => '2025-05-10',
            'situacao' => 'pendente',
        ]);
        $this->assertInstanceOf('App\Model\Entity\Tarefa', $this->Tarefas->save($tarefa));
    }
}
