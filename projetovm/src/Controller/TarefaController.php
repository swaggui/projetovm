<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Http\Session;

class TarefaController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
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

        $situacao = $this->request->getQuery('situacao');
        if (!empty($situacao) && in_array($situacao, ['pendente', 'em andamento', 'concluída'])) {
            $conditions['situacao'] = $situacao;
        }

        $dataCriacao = $this->request->getQuery('data_criacao');
        if (!empty($dataCriacao)) {
            $conditions['DATE(data_criacao)'] = $dataCriacao;
        }

        $query = $this->Tarefa->find()->where($conditions);
        $tarefa = $this->paginate($query);

        $situacoes = [
            '' => 'Todas',
            'pendente' => 'Pendente',
            'em andamento' => 'Em andamento',
            'concluída' => 'Concluída'
        ];

        $this->set(compact('tarefa', 'situacoes', 'situacao', 'dataCriacao'));
    }

    public function view($id = null)
    {
        $tarefa = $this->Tarefa->get($id, contain: []);
        $this->set(compact('tarefa'));
    }

    public function add()
    {
        $tarefa = $this->Tarefa->newEmptyEntity();
        if ($this->request->is('post')) {
            $tarefa = $this->Tarefa->patchEntity($tarefa, $this->request->getData());
            if ($this->Tarefa->save($tarefa)) {
                $session = $this->request->getSession();
                $userEmail = $session->read('User.email');
                if (!empty($userEmail)) {
                    try {
                        $mailer = new Mailer('default');
                        $mailer
                            ->setTo($userEmail)
                            ->setSubject('Nova Tarefa Criada')
                            ->setViewVars(['tarefa' => $tarefa])
                            ->viewBuilder()
                            ->setTemplate('tarefa_criada');
                        $mailer->deliver();
                    } catch (\Exception $e) {
                        $this->Flash->warning('Tarefa salva, mas não foi possível enviar o e-mail: ' . $e->getMessage());
                    }
                } else {
                    $this->Flash->warning('Tarefa salva, mas o e-mail do usuário não está definido.');
                }
                $this->Flash->success('Tarefa salva com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Não foi possível salvar a tarefa. Tente novamente.');
        }
        $this->set(compact('tarefa'));
    }

    public function edit($id = null)
    {
        $tarefa = $this->Tarefa->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarefa = $this->Tarefa->patchEntity($tarefa, $this->request->getData());
            if ($this->Tarefa->save($tarefa)) {
                $session = $this->request->getSession();
                $userEmail = $session->read('User.email');
                if (!empty($userEmail)) {
                    try {
                        $mailer = new Mailer('default');
                        $mailer
                            ->setTo($userEmail)
                            ->setSubject('Tarefa Editada')
                            ->setViewVars(['tarefa' => $tarefa])
                            ->viewBuilder()
                            ->setTemplate('tarefa_editada');
                        $mailer->deliver();
                    } catch (\Exception $e) {
                        $this->Flash->warning('Tarefa atualizada, mas não foi possível enviar o e-mail: ' . $e->getMessage());
                    }
                } else {
                    $this->Flash->warning('Tarefa atualizada, mas o e-mail do usuário não está definido.');
                }
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
        $tarefa = $this->Tarefa->get($id);
        if ($this->Tarefa->delete($tarefa)) {
            $this->Flash->success('Tarefa excluída com sucesso.');
        } else {
            $this->Flash->error('Não foi possível excluir a tarefa. Tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function exportPdf()
    {
        $conditions = [];

        $situacao = $this->request->getQuery('situacao');
        if (!empty($situacao) && in_array($situacao, ['pendente', 'em andamento', 'concluída'])) {
            $conditions['situacao'] = $situacao;
        }

        $dataCriacao = $this->request->getQuery('data_criacao');
        if (!empty($dataCriacao)) {
            $conditions['DATE(data_criacao)'] = $dataCriacao;
        }

        $tarefas = $this->Tarefa->find()->where($conditions)->all();

        // Configurar a visualização para PDF
        $this->viewBuilder()
            ->setClassName('CakePdf.Pdf')
            ->setTemplatePath('Tarefa/pdf')
            ->setTemplate('export')
            ->setOption('pdfConfig', [
                'isDownload' => true,
                'filename' => 'tarefas_' . date('Y-m-d') . '.pdf'
            ]);

        $this->set(compact('tarefas'));
    }
}
