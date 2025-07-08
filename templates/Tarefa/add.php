<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarefa $tarefa
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Listar Tarefas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tarefa form content">
            <?= $this->Form->create($tarefa) ?>
            <fieldset>
                <legend><?= __('Adicionar Tarefa') ?></legend>
                <?php
                echo $this->Form->control('descricao', ['label' => 'Descrição', 'required' => true]);
                echo $this->Form->control('data_prevista', ['type' => 'date', 'label' => 'Data Prevista', 'required' => true]);
                echo $this->Form->control('data_encerramento', ['type' => 'date', 'label' => 'Data de Encerramento', 'empty' => true]);
                echo $this->Form->control('situacao', [
                    'options' => [
                        'pendente' => 'Pendente',
                        'em andamento' => 'Em andamento',
                        'concluída' => 'Concluída'
                    ],
                    'label' => 'Situação',
                    'required' => true,
                    'default' => 'pendente'
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
