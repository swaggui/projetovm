<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarefa $tarefa
 */
?>
Tarefa Editada

Olá,

A seguinte tarefa foi editada no sistema:

- Descrição: <?= h($tarefa->descricao) ?>
- Data de Criação: <?= h($tarefa->data_criacao) ?>
- Data Prevista: <?= h($tarefa->data_prevista) ?>
- Data de Encerramento: <?= h($tarefa->data_encerramento) ?: 'Não definida' ?>
- Situação: <?= h($tarefa->situacao) ?>

Você pode visualizar todas as suas tarefas em: <?= $this->Url->build(['controller' => 'Tarefa', 'action' => 'index'], ['fullBase' => true]) ?>

Atenciosamente,
Sistema de Tarefas
