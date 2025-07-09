<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class TarefaController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $session = $this->request->getSession();
        if (!$session->read('User.id')) {
            $this->Flash->error('Por favor, faça login para acessar o sistema.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function index()
    {
        $conditions = [];
        $conditions['user_id'] = $this->request->getSession()->read('User.id');

        $situacao = $this->request->getQuery('situacao');
        if (!empty($situacao) && in_array($situacao, ['pendente', 'em andamento', 'concluída'])) {
            $conditions['situacao'] = $situacao;
        }

        $dataCriacao = $this->request->getQuery('data_criacao');
        if (!empty($dataCriacao)) {
            $conditions['DATE(data_criacao)'] = $dataCriacao;
        }

        $query = $this->fetchTable('Tarefas')->find()->where($conditions);
        $tarefas = $this->paginate($query);

        $situacoes = [
            '' => 'Todas',
            'pendente' => 'Pendente',
            'em andamento' => 'Em andamento',
            'concluída' => 'Concluída'
        ];

        $this->set(compact('tarefas', 'situacoes', 'situacao', 'dataCriacao'));
    }

    public function view($id = null)
    {
        $tarefa = $this->fetchTable('Tarefas')->get($id);
        $this->set(compact('tarefa'));
    }

    public function add()
    {
        $tarefasTable = $this->fetchTable('Tarefas');
        $tarefa = $tarefasTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->request->getSession()->read('User.id');
            $tarefa = $tarefasTable->patchEntity($tarefa, $data);

            if ($tarefasTable->save($tarefa)) {
                $this->Flash->success('Tarefa salva com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Não foi possível salvar a tarefa. Tente novamente.');
        }
        $this->set(compact('tarefa'));
    }

    public function edit($id = null)
    {
        $tarefasTable = $this->fetchTable('Tarefas');
        $tarefa = $tarefasTable->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarefa = $tarefasTable->patchEntity($tarefa, $this->request->getData());
            if ($tarefasTable->save($tarefa)) {
                $this->Flash->success('Tarefa atualizada com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Não foi possível atualizar a tarefa. Tente novamente.');
        }
        $this->set(compact('tarefa'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarefasTable = $this->fetchTable('Tarefas');
        $tarefa = $tarefasTable->get($id);
        if ($tarefasTable->delete($tarefa)) {
            $this->Flash->success('Tarefa excluída com sucesso.');
        } else {
            $this->Flash->error('Não foi possível excluir a tarefa. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function exportPdf()
    {
        $conditions = [];
        $conditions['user_id'] = $this->request->getSession()->read('User.id');

        $situacao = $this->request->getQuery('situacao');
        if (!empty($situacao) && in_array($situacao, ['pendente', 'em andamento', 'concluída'])) {
            $conditions['situacao'] = $situacao;
        }

        $dataCriacao = $this->request->getQuery('data_criacao');
        if (!empty($dataCriacao)) {
            $conditions['DATE(data_criacao)'] = $dataCriacao;
        }

        $tarefas = $this->fetchTable('Tarefas')->find()->where($conditions)->all();

        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true,
                'filename' => 'tarefas_' . date('Y-m-d') . '.pdf'
            ]
        );
        $this->viewBuilder()->setTemplate('export', 'pdf/default');
        $this->set(compact('tarefas'));
    }
}
