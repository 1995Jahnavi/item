<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StockMovementsFixture
 *
 */
class StockMovementsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'from_warehouse_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'to_warehouse_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'stock_movements_ibfk_1' => ['type' => 'index', 'columns' => ['from_warehouse_id'], 'length' => []],
            'stock_movements_ibfk_2' => ['type' => 'index', 'columns' => ['to_warehouse_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'stock_movements_ibfk_1' => ['type' => 'foreign', 'columns' => ['from_warehouse_id'], 'references' => ['warehouses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_movements_ibfk_2' => ['type' => 'foreign', 'columns' => ['to_warehouse_id'], 'references' => ['warehouses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'id' => 1,
                'from_warehouse_id' => 1,
                'to_warehouse_id' => 1
            ],
        ];
        parent::init();
    }
}
