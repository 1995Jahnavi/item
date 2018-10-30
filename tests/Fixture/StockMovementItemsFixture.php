<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StockMovementItemsFixture
 *
 */
class StockMovementItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'item_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'stock_movement_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'quantity' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'unit_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        '_indexes' => [
            'item_id' => ['type' => 'index', 'columns' => ['item_id'], 'length' => []],
            'stock_movement_id' => ['type' => 'index', 'columns' => ['stock_movement_id'], 'length' => []],
            'stock_movement_items_ibfk_3' => ['type' => 'index', 'columns' => ['unit_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'stock_movement_items_ibfk_1' => ['type' => 'foreign', 'columns' => ['item_id'], 'references' => ['items', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_movement_items_ibfk_2' => ['type' => 'foreign', 'columns' => ['stock_movement_id'], 'references' => ['stock_movements', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_movement_items_ibfk_3' => ['type' => 'foreign', 'columns' => ['unit_id'], 'references' => ['units', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'item_id' => 1,
                'stock_movement_id' => 1,
                'quantity' => 1,
                'unit_id' => 1,
                'id' => 1
            ],
        ];
        parent::init();
    }
}
