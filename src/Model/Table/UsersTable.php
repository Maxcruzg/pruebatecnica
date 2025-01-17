<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'roles_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('Courses', [
            'through' => 'UserCourses',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'course_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('lastname')
            ->requirePresence('lastname', 'create')
            ->notEmptyString('lastname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');


        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->regex(
                'password',
                '/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/',
                'La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos.'
            );

        $validator
            ->scalar('rut')
            ->maxLength('rut', 12)
            ->requirePresence('rut', 'create')
            ->notEmptyString('rut', 'El RUT es obligatorio')
            ->regex(
                'rut',
                '/^\d{7,8}[0-9Kk]$/',
                'El rut ingresado no es válido'
            );

        // Validación de las contraseñas coincidentes
        $validator
            ->add('password2', 'custom', [
                'rule' => function ($value, $context) {
                    return $value === $context['data']['password'];
                },
                'message' => 'Las contraseñas no coinciden.',
            ]);

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['roles_id'], 'Roles'));

        return $rules;
    }

    public function inactive($userId)
    {
        $user = $this->get($userId);
        $user->is_active = 0;

        if ($this->save($user)) {
            return true;
        }

        return false;
    }

    public function activate($userId)
    {
        $user = $this->get($userId);
        $user->is_active = 1;
        if ($this->save($user)) {
            return true;
        }
        return false;
    }
}
