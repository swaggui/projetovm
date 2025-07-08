<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarefa $tarefa
 */
?>
Nova Tarefa Criada

Olá,

Uma nova tarefa foi criada no sistema:

- Descrição: <?= h($tarefa->descricao) ?>
- Data de Criação: <?= h($tarefa->data_criacao) ?>
- Data Prevista: <?= h($tarefa->data_prevista) ?>
- Situação: <?= h($tarefa->situacao) ?>

Você pode visualizar todas as suas tarefas em: <?= $this->Url->build(['controller' => 'Tarefa', 'action' => 'index'], ['fullBase' => true]) ?>

Atenciosamente,
Sistema de Tarefas
