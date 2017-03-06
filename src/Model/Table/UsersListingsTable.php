<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersListings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $UsersListings
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Listings
 *
 * @method \App\Model\Entity\UsersListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersListing findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersListingsTable extends Table
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

        $this->table('users_listings');
        $this->displayField('users_listing_id');
        $this->primaryKey('users_listing_id');

        $this->belongsTo('UsersListings', [
            'foreignKey' => 'users_listing_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['users_listing_id'], 'UsersListings'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }
}
