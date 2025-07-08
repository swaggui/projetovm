<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tarefa> $tarefas
 * @var array $situacoes
 * @var string|null $situacao
 * @var string|null $dataCriacao
 */
?>
<div class="tarefa index content">
    <?= $this->Html->link(__('Nova Tarefa'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link('Exportar para PDF', ['action' => 'exportPdf', '?' => $this->request->getQuery()], ['class' => 'button float-right']) ?>
    <h3><?= __('Tarefas') ?></h3>
    <div class="filters">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <fieldset>
            <legend>Filtros</legend>
            <?= $this->Form->control('situacao', [
                'options' => $situacoes,
                'value' => $situacao,
                'label' => 'Situação',
                'empty' => false
            ]) ?>
            <?= $this->Form->control('data_criacao', [
                'type' => 'date',
                'value' => $dataCriacao,
                'label' => 'Data de Criação'
            ]) ?>
        </fieldset>
        <?= $this->Form->button('Filtrar') ?>
        <?= $this->Html->link('Limpar Filtros', ['action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('descricao', 'Descrição') ?></th>
                <th><?= $this->Paginator->sort('data_criacao', 'Data de Criação') ?></th>
                <th><?= $this->Paginator->sort('data_prevista', 'Data Prevista') ?></th>
                <th><?= $this->Paginator->sort('data_encerramento', 'Data de Encerramento') ?></th>
                <th><?= $this->Paginator->sort('situacao', 'Situação') ?></th>
                <th class="actions"><?= __('Ações') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= $this->Number->format($tarefa->id) ?></td>
                    <td><?= h($tarefa->descricao) ?></td>
                    <td><?= h($tarefa->data_criacao) ?></td>
                    <td><?= h($tarefa->data_prevista) ?></td>
                    <td><?= h($tarefa->data_encerramento) ?></td>
                    <td><?= h($tarefa->situacao) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $tarefa->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $tarefa->id]) ?>
                        <?= $this->Form->postLink(
                            __('Excluir'),
                            ['action' => 'delete', $tarefa->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Tem certeza de que deseja excluir a tarefa # {0}?', $tarefa->id),
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeira')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próxima') . ' >') ?>
            <?= $this->Paginator->last(__('última') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de um total de {{count}}')) ?></p>
    </div>
</div>
