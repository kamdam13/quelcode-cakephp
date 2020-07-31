<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity
 *
 * @property int $id
 * @property int $rated_user_id
 * @property int $rated_by_user_id
 * @property int $point
 * @property string $comment
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\RatedUser $rated_user
 * @property \App\Model\Entity\RatedByUser $rated_by_user
 */
class Rating extends Entity
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
        'rated_user_id' => true,
        'rated_by_user_id' => true,
        'point' => true,
        'comment' => true,
        'created' => true,
        'user' => true,
    ];
}
