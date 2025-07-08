<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tarefa extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'descricao' => true,
        'data_criacao' => true,
        'data_prevista' => true,
        'data_encerramento' => true,
        'situacao' => true,
    ];
}
