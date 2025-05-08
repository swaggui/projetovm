<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class TarefaControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected array $fixtures = ['app.Tarefa', 'app.Users'];

    public function setUp(): void
    {
        parent::setUp();
        // Simular um usuário logado
        $this->session(['User' => ['id' => 1, 'email' => 'gradeurt@gmail.com']]);
    }

    public function testIndexAction(): void
    {
        $this->get('/tarefa');
        $this->assertResponseOk();
        $this->assertResponseContains('Tarefa de teste 1');
    }

    public function testIndexWithSituacaoFilter(): void
    {
        $this->get('/tarefa?situacao=pendente');
        $this->assertResponseOk();
        $this->assertResponseContains('Tarefa de teste 1');
        $this->assertResponseNotContains('Tarefa de teste 2');
    }

    public function testIndexWithDataCriacaoFilter(): void
    {
        $this->get('/tarefa?data_criacao=2025-05-01');
        $this->assertResponseOk();
        $this->assertResponseContains('Tarefa de teste 1');
        $this->assertResponseNotContains('Tarefa de teste 2');
    }

    public function testViewActionValidId(): void
    {
        $this->get('/tarefa/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Tarefa de teste 1');
    }

    public function testViewActionInvalidId(): void
    {
        $this->get('/tarefa/view/999');
        $this->assertResponseCode(404);
    }

    public function testAddAction(): void
    {
        $data = [
            'descricao' => 'Nova tarefa teste',
            'data_prevista' => '2025-05-20',
            'situacao' => 'pendente',
        ];
        $this->post('/tarefa/add', $data);
        $this->assertRedirect(['action' => 'index']);
        $this->assertFlashMessage('Tarefa salva com sucesso.');
    }

    public function testAddActionInvalidData(): void
    {
        $data = [
            'descricao' => '',
            'data_prevista' => '',
            'situacao' => '',
        ];
        $this->post('/tarefa/add', $data);
        $this->assertResponseOk();
        $this->assertFlashMessage('Não foi possível salvar a tarefa. Tente novamente.');
    }

    public function testEditAction(): void
    {
        $data = [
            'descricao' => 'Tarefa editada',
            'data_prevista' => '2025-05-12',
            'situacao' => 'em andamento',
        ];
        $this->put('/tarefa/edit/1', $data);
        $this->assertRedirect(['action' => 'index']);
        $this->assertFlashMessage('Tarefa atualizada com sucesso.');
    }

    public function testDeleteAction(): void
    {
        $this->delete('/tarefa/delete/1');
        $this->assertRedirect(['action' => 'index']);
        $this->assertFlashMessage('Tarefa excluída com sucesso.');
    }

    public function testExportPdfAction(): void
    {
        $this->get('/tarefa/exportPdf');
        $this->assertResponseOk();
        $this->assertHeader('Content-Type', 'application/pdf');
        $this->assertHeaderContains('Content-Disposition', 'attachment; filename="tarefas_');
    }
}
