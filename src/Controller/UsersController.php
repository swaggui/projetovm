<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Session;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Permitir acesso público a todas as ações deste controlador
        //$this->Auth = null; // Desativar qualquer autenticação padrão
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');

            // Buscar usuário
            $user = $this->Users->find()
                ->where(['email' => $email, 'password' => $password])
                ->first();

            if ($user) {
                // Salvar usuário na sessão
                $session = $this->request->getSession();
                $session->write('User.id', $user->id);
                $session->write('User.email', $user->email);
                $this->Flash->success('Login realizado com sucesso.');
                return $this->redirect(['controller' => 'Tarefa', 'action' => 'index']);
            }

            $this->Flash->error('Email ou senha inválidos.');
        }
    }

    public function logout()
    {
        $session = $this->request->getSession();
        $session->delete('User');
        $session->destroy();
        $this->Flash->success('Você saiu do sistema.');
        return $this->redirect(['action' => 'login']);
    }

    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('Usuário criado com sucesso.');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('Não foi possível criar o usuário. Tente novamente.');
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
