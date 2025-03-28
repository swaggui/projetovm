<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tarefa Model
 *
 * @method \App\Model\Entity\Tarefa newEmptyEntity()
 * @method \App\Model\Entity\Tarefa newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tarefa> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tarefa get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tarefa findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tarefa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tarefa> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tarefa|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tarefa saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tarefa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarefa>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarefa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarefa> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarefa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarefa>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tarefa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tarefa> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TarefaTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tarefa');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
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
            ->notEmptyString('situacao');

        return $validator;
    }
}
