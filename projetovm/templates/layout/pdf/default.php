<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Tarefas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?= $this->fetch('content') ?>
</body>
</html>
