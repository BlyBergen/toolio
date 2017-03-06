<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listing Entity
 *
 * @property int $id
 * @property string $title
 * @property string $category
 * @property string $description
 * @property string $add1
 * @property string $add2
 * @property string $city
 * @property string $state
 * @property int $zipcode
 * @property float $price
 * @property string $time_unit
 * @property float $rating
 * @property string $photo_url
 * @property string $contact
 * @property bool $item_workshop
 * @property bool $pickup_onsite
 * @property int $saved
 * @property int $views
 * @property int $user_id
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Rating[] $ratings
 */
class Listing extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
