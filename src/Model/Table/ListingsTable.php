<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Listings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Ratings
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Listing get($primaryKey, $options = [])
 * @method \App\Model\Entity\Listing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Listing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Listing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Listing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Listing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Listing findOrCreate($search, callable $callback = null, $options = [])
 */
class ListingsTable extends Table
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

        $this->table('listings');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Ratings', [
            'foreignKey' => 'listing_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'listing_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_listings'
        ]);

        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->value('category')
        ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['title', 'description']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('add1', 'create')
            ->notEmpty('add1');

        $validator
            ->requirePresence('add2', 'create')
            ->notEmpty('add2');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->integer('zipcode')
            ->requirePresence('zipcode', 'create')
            ->notEmpty('zipcode');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('time_unit', 'create')
            ->notEmpty('time_unit');

        $validator
            ->decimal('rating')
            ->requirePresence('rating', 'create')
            ->notEmpty('rating');

        $validator
            ->requirePresence('photo_url', 'create')
            ->notEmpty('photo_url');

        $validator
            ->requirePresence('contact', 'create')
            ->notEmpty('contact');

        $validator
            ->boolean('item_workshop')
            ->requirePresence('item_workshop', 'create')
            ->notEmpty('item_workshop');

        $validator
            ->boolean('pickup_onsite')
            ->requirePresence('pickup_onsite', 'create')
            ->notEmpty('pickup_onsite');

        $validator
            ->integer('saved')
            ->requirePresence('saved', 'create')
            ->notEmpty('saved');

        $validator
            ->integer('views')
            ->requirePresence('views', 'create')
            ->notEmpty('views');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function findUsers(Query $query, array $options)
    {
      return $this->find()
        ->distinct(['Listings.id'])
        ->matching('Users', function ($q) use ($options){
          return $q->where(['Users.id IN' => $options['users']]);
        });
    }

    public function findCategory(Query $query, array $options)
    {
      return $this->find()
        ->distinct(['Listings.id'])
        ->matching('Listings', function ($q) use ($options){
          return $q->where(['Listings.category IN' => $options['categories']]);
        });

    }
}
