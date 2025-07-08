<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class TarefaControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected array $fixtures = ['app.Tarefas', 'app.Users'];

    public function setUp(): void
    {
        parent::setUp();
        $this->session([
            'User' => [
                'id' => 1,
                'email' => 'teste@exemplo.com',
            ],
        ]);
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
        $this->enableCsrfToken();
        $data = [
            'descricao' => 'Nova tarefa teste',
            'data_prevista' => '2025-05-20',
            'situacao' => 'pendente',
        ];
        $this->post('/tarefa/add', $data);
        $this->assertRedirect(['controller' => 'Tarefa', 'action' => 'index']);
        $this->assertFlashMessage('Tarefa salva com sucesso.');
    }

    public function testAddActionInvalidData()
    {
        // Habilita o token CSRF
        $this->enableCsrfToken();

        // Pega a tabela de Tarefas
        $tarefasTable = $this->getTableLocator()->get('Tarefas');
        // Conta quantas tarefas existem ANTES da tentativa de adicionar
        $countBefore = $tarefasTable->find()->count();

        // Envia dados inválidos
        $data = [
            'descricao' => '',
            'data_prevista' => '',
            'situacao' => '',
        ];
        $this->post('/tarefa/add', $data);

        // Conta quantas tarefas existem DEPOIS
        $countAfter = $tarefasTable->find()->count();

        // O teste passa se nenhuma nova tarefa foi adicionada
        $this->assertEquals($countBefore, $countAfter);
        // E verifica se a página recarregou (não houve redirecionamento)
        $this->assertResponseOk();
    }

    public function testEditAction(): void
    {
        $this->enableCsrfToken();
        $data = [
            'descricao' => 'Tarefa editada',
            'data_prevista' => '2025-05-12',
            'situacao' => 'em andamento',
        ];
        $this->put('/tarefa/edit/1', $data);
        $this->assertRedirect(['controller' => 'Tarefa', 'action' => 'index']);
        $this->assertFlashMessage('Tarefa atualizada com sucesso.');
    }

    public function testDeleteAction(): void
    {
        $this->enableCsrfToken();
        $this->delete('/tarefa/delete/1');
        $this->assertRedirect(['controller' => 'Tarefa', 'action' => 'index']);
        $this->assertFlashMessage('Tarefa excluída com sucesso.');
    }

    /*public function testExportPdfAction(): void
    {
        $this->get('/tarefa/exportPdf');
        $this->assertResponseOk();
        $this->assertHeader('Content-Type', 'application/pdf');
        $this->assertHeaderContains('Content-Disposition', 'attachment; filename="tarefas_');
    }*/
}
