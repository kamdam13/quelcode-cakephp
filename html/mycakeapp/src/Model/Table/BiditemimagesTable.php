<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Biditemimages Model
 *
 * @property \App\Model\Table\BiditemsTable&\Cake\ORM\Association\BelongsTo $Biditems
 *
 * @method \App\Model\Entity\Biditemimage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Biditemimage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Biditemimage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Biditemimage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditemimage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Biditemimage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Biditemimage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Biditemimage findOrCreate($search, callable $callback = null, $options = [])
 */
class BiditemimagesTable extends Table
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

        $this->setTable('biditemimages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Biditems', [
            'foreignKey' => 'biditem_id',
            'joinType' => 'INNER',
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
            ->scalar('biditem_image_file_name')
            ->maxLength('biditem_image_file_name', 255)
            ->requirePresence('biditem_image_file_name', 'create')
            ->notEmptyFile('biditem_image_file_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['biditem_id'], 'Biditems'));

        return $rules;
    }
}
