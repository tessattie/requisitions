<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Requisition Entity
 *
 * @property int $id
 * @property string|null $requisition_number
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenDate $due_date
 * @property int $category_id
 * @property string|null $title
 * @property string|null $location
 * @property string|null $full_name
 * @property string|null $description
 * @property float|null $amount_requested
 * @property float|null $amount_authorized
 * @property int $archived
 * @property int $rate
 * @property int $status
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\Note[] $notes
 */
class Requisition extends Entity
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
        'requisition_number' => true,
        'created' => true,
        'modified' => true,
        'due_date' => true,
        'category_id' => true,
        'title' => true,
        'location' => true,
        'full_name' => true,
        'description' => true,
        'amount_requested' => true,
        'amount_authorized' => true,
        'archived' => true,
        'rate' => true,
        'status' => true,
        'category' => true,
        'documents' => true,
        'notes' => true,
    ];
}
