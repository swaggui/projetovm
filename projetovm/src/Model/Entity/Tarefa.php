<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tarefa Entity
 *
 * @property int $id
 * @property string $descricao
 * @property \Cake\I18n\DateTime|null $data_criacao
 * @property \Cake\I18n\Date $data_prevista
 * @property \Cake\I18n\Date|null $data_encerramento
 * @property string $situacao
 */
class Tarefa extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'descricao' => true,
        'data_criacao' => true,
        'data_prevista' => true,
        'data_encerramento' => true,
        'situacao' => true,
    ];
}
