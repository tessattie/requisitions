<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuthorizationsRoles Model
 *
 * @property \App\Model\Table\AuthorizationsTable&\Cake\ORM\Association\BelongsTo $Authorizations
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\AuthorizationsRole newEmptyEntity()
 * @method \App\Model\Entity\AuthorizationsRole newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuthorizationsRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuthorizationsRole|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuthorizationsRole[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AuthorizationsRolesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('authorizations_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Authorizations', [
            'foreignKey' => 'authorization_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('authorization_id')
            ->requirePresence('authorization_id', 'create')
            ->notEmptyString('authorization_id');

        $validator
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->notEmptyString('role_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('authorization_id', 'Authorizations'), ['errorField' => 'authorization_id']);
        $rules->add($rules->existsIn('role_id', 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
