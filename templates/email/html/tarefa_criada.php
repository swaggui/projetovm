<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarefa $tarefa
 */
?>
<h2>Nova Tarefa Criada</h2>
<p>Olá,</p>
<p>Uma nova tarefa foi criada no sistema:</p>
<ul>
    <li><strong>Descrição:</strong> <?= h($tarefa->descricao) ?></li>
    <li><strong>Data de Criação:</strong> <?= h($tarefa->data_criacao) ?></li>
    <li><strong>Data Prevista:</strong> <?= h($tarefa->data_prevista) ?></li>
    <li><strong>Situação:</strong> <?= h($tarefa->situacao) ?></li>
</ul>
<p>Você pode visualizar todas as suas tarefas em: <?= $this->Url->build(['controller' => 'Tarefa', 'action' => 'index'], ['fullBase' => true]) ?></p>
<p>Atenciosamente,<br>Sistema de Tarefas</p>
