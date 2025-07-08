<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tarefa> $tarefas
 */
?>
<h1>Lista de Tarefas</h1>
<table style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr style="border-bottom: 1px solid #000;">
        <th style="padding: 5px; text-align: left;">ID</th>
        <th style="padding: 5px; text-align: left;">Descrição</th>
        <th style="padding: 5px; text-align: left;">Data de Criação</th>
        <th style="padding: 5px; text-align: left;">Data Prevista</th>
        <th style="padding: 5px; text-align: left;">Data de Encerramento</th>
        <th style="padding: 5px; text-align: left;">Situação</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tarefas as $tarefa): ?>
        <tr style="border-bottom: 1px solid #ccc;">
            <td style="padding: 5px;"><?= h($tarefa->id) ?></td>
            <td style="padding: 5px;"><?= h($tarefa->descricao) ?></td>
            <td style="padding: 5px;"><?= h($tarefa->data_criacao) ?></td>
            <td style="padding: 5px;"><?= h($tarefa->data_prevista) ?></td>
            <td style="padding: 5px;"><?= h($tarefa->data_encerramento) ?: 'N/A' ?></td>
            <td style="padding: 5px;"><?= h($tarefa->situacao) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
