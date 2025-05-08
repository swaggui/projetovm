<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use App\Model\Table\TarefaTable;

class TarefaTableTest extends TestCase
{
    protected array $fixtures = ['app.Tarefa', 'app.Users'];

    protected $Tarefa;

    public function setUp(): void
    {
        parent::setUp();
        $this->Tarefa = $this->getTableLocator()->get('Tarefa');
    }

    public function tearDown(): void
    {
        unset($this->Tarefa);
        parent::tearDown();
    }

    // Teste 1: Verifica se a descrição é obrigatória
    public function testValidationDescricaoRequired(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'data_prevista' => '2025-05-10',
            'situacao' => 'pendente',
        ]);
        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('descricao', $errors);
        $this->assertEquals('This field cannot be left empty', $errors['descricao']['_empty']);
    }

    // Teste 2: Verifica se a descrição tem no máximo 255 caracteres
    public function testValidationDescricaoMaxLength(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => str_repeat('a', 256),
            'data_prevista' => '2025-05-10',
            'situacao' => 'pendente',
        ]);
        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('descricao', $errors);
        $this->assertEquals('The provided value is invalid', $errors['descricao']['maxLength']);
    }

    // Teste 3: Verifica se a data prevista é obrigatória
    public function testValidationDataPrevistaRequired(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => 'Tarefa teste',
            'situacao' => 'pendente',
        ]);
        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('data_prevista', $errors);
        $this->assertEquals('This field cannot be left empty', $errors['data_prevista']['_empty']);
    }

    // Teste 4: Verifica se a situação é obrigatória
    public function testValidationSituacaoRequired(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => 'Tarefa teste',
            'data_prevista' => '2025-05-10',
        ]);
        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('situacao', $errors);
        $this->assertEquals('This field cannot be left empty', $errors['situacao']['_empty']);
    }

    // Teste 5: Verifica se a situação aceita apenas valores válidos
    public function testValidationSituacaoInvalid(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => 'Tarefa teste',
            'data_prevista' => '2025-05-10',
            'situacao' => 'invalido',
        ]);
        $errors = $tarefa->getErrors();
        $this->assertArrayHasKey('situacao', $errors);
        $this->assertEquals('The provided value is invalid', $errors['situacao']['inList']);
    }

    // Teste 6: Cria uma tarefa válida
    public function testCreateValidTarefa(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => 'Nova tarefa',
            'data_prevista' => '2025-05-10',
            'situacao' => 'pendente',
        ]);
        $result = $this->Tarefa->save($tarefa);
        $this->assertNotFalse($result);
        $this->assertEquals('Nova tarefa', $result->descricao);
    }

    // Teste 7: Lê uma tarefa existente
    public function testReadTarefa(): void
    {
        $tarefa = $this->Tarefa->get(1);
        $this->assertEquals('Tarefa de teste 1', $tarefa->descricao);
        $this->assertEquals('pendente', $tarefa->situacao);
    }

    // Teste 8: Atualiza uma tarefa existente
    public function testUpdateTarefa(): void
    {
        $tarefa = $this->Tarefa->get(1);
        $tarefa = $this->Tarefa->patchEntity($tarefa, ['situacao' => 'concluída']);
        $result = $this->Tarefa->save($tarefa);
        $this->assertNotFalse($result);
        $this->assertEquals('concluída', $result->situacao);
    }

    // Teste 9: Exclui uma tarefa
    public function testDeleteTarefa(): void
    {
        $tarefa = $this->Tarefa->get(1);
        $result = $this->Tarefa->delete($tarefa);
        $this->assertTrue($result);
        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        $this->Tarefa->get(1);
    }

    // Teste 10: Verifica se data_encerramento pode ser nula
    public function testDataEncerramentoNullable(): void
    {
        $tarefa = $this->Tarefa->newEntity([
            'descricao' => 'Tarefa teste',
            'data_prevista' => '2025-05-10',
            'situacao' => 'pendente',
            'data_encerramento' => null,
        ]);
        $result = $this->Tarefa->save($tarefa);
        $this->assertNotFalse($result);
        $this->assertNull($result->data_encerramento);
    }
}
