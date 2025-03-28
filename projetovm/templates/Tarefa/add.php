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
            <?= $this->Html->link(__('List Tarefa'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tarefa form content">
            <?= $this->Form->create($tarefa) ?>
            <fieldset>
                <legend><?= __('Add Tarefa') ?></legend>
                <?php
                    echo $this->Form->control('descricao');
                    echo $this->Form->control('data_criacao', ['empty' => true]);
                    echo $this->Form->control('data_prevista');
                    echo $this->Form->control('data_encerramento', ['empty' => true]);
                    echo $this->Form->control('situacao');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
