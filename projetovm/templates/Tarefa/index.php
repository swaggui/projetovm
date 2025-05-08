<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tarefa> $tarefa
 * @var array $situacoes
 * @var string|null $situacao
 * @var string|null $dataCriacao
 */
?>
<div class="tarefa index content">
    <?= $this->Html->link(__('New Tarefa'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link('Exportar para PDF', ['action' => 'exportPdf', '?' => $this->request->getQuery()], ['class' => 'button float-right']) ?>
    <h3><?= __('Tarefa') ?></h3>
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
                    <th><?= $this->Paginator->sort('descricao') ?></th>
                    <th><?= $this->Paginator->sort('data_criacao') ?></th>
                    <th><?= $this->Paginator->sort('data_prevista') ?></th>
                    <th><?= $this->Paginator->sort('data_encerramento') ?></th>
                    <th><?= $this->Paginator->sort('situacao') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarefa as $tarefa): ?>
                <tr>
                    <td><?= $this->Number->format($tarefa->id) ?></td>
                    <td><?= h($tarefa->descricao) ?></td>
                    <td><?= h($tarefa->data_criacao) ?></td>
                    <td><?= h($tarefa->data_prevista) ?></td>
                    <td><?= h($tarefa->data_encerramento) ?></td>
                    <td><?= h($tarefa->situacao) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tarefa->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tarefa->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $tarefa->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $tarefa->id),
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
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
