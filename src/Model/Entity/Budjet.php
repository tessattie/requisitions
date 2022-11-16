<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Budjet Entity
 *
 * @property int $id
 * @property string $name
 *
 */
class Budjet extends Entity
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
    protected $_accessible = [
        'department_id' => true,
        'year' => true,
        'month' => true,
        'htg_amount' => true,
        'usd_amount' => true,
        'created' => true,
        'modified' => true,
    ];
}
