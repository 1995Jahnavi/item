<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Warehouse Entity
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property int $unit_id
 * @property int $item_id
 *
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Item $item
 */
class Warehouse extends Entity
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
        'name' => true,
        'quantity' => true,
        'unit_id' => true,
        'item_id' => true,
        'unit' => true,
        'item' => true
    ];
}
