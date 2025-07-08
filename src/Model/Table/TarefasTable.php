<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TarefasTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tarefas');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 255)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->dateTime('data_criacao')
            ->allowEmptyDateTime('data_criacao');

        $validator
            ->date('data_prevista')
            ->requirePresence('data_prevista', 'create')
            ->notEmptyDate('data_prevista');

        $validator
            ->date('data_encerramento')
            ->allowEmptyDate('data_encerramento');

        $validator
            ->scalar('situacao')
            ->inList('situacao', ['pendente', 'em andamento', 'concluída'])
            ->requirePresence('situacao', 'create')
            ->notEmptyString('situacao');

        return $validator;
    }
}
