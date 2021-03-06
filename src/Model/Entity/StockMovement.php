<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockMovement Entity
 *
 * @property int $id
 * @property int $from_warehouse_id
 * @property int $to_warehouse_id
 *
 * @property \App\Model\Entity\Warehouse $warehouse
 * @property \App\Model\Entity\StockMovementItem[] $stock_movement_items
 */
class StockMovement extends Entity
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
        'from_warehouse_id' => true,
        'to_warehouse_id' => true,
        'warehouse' => true,
        'stock_movement_items' => true
    ];
}
