<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarefa $tarefa
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tarefa'), ['action' => 'edit', $tarefa->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tarefa'), ['action' => 'delete', $tarefa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tarefa->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tarefa'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tarefa'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tarefa view content">
            <h3><?= h($tarefa->descricao) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($tarefa->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Situacao') ?></th>
                    <td><?= h($tarefa->situacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tarefa->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data Criacao') ?></th>
                    <td><?= h($tarefa->data_criacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data Prevista') ?></th>
                    <td><?= h($tarefa->data_prevista) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data Encerramento') ?></th>
                    <td><?= h($tarefa->data_encerramento) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>