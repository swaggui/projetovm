<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tarefa Controller
 *
 * @property \App\Model\Table\TarefaTable $Tarefa
 */
class TarefaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tarefa->find();
        $tarefa = $this->paginate($query);

        $this->set(compact('tarefa'));
    }

    /**
     * View method
     *
     * @param string|null $id Tarefa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tarefa = $this->Tarefa->get($id, contain: []);
        $this->set(compact('tarefa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tarefa = $this->Tarefa->newEmptyEntity();
        if ($this->request->is('post')) {
            $tarefa = $this->Tarefa->patchEntity($tarefa, $this->request->getData());
            if ($this->Tarefa->save($tarefa)) {
                $this->Flash->success(__('The tarefa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tarefa could not be saved. Please, try again.'));
        }
        $this->set(compact('tarefa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tarefa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tarefa = $this->Tarefa->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarefa = $this->Tarefa->patchEntity($tarefa, $this->request->getData());
            if ($this->Tarefa->save($tarefa)) {
                $this->Flash->success(__('The tarefa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tarefa could not be saved. Please, try again.'));
        }
        $this->set(compact('tarefa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tarefa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarefa = $this->Tarefa->get($id);
        if ($this->Tarefa->delete($tarefa)) {
            $this->Flash->success(__('The tarefa has been deleted.'));
        } else {
            $this->Flash->error(__('The tarefa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
