<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockMovementItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockMovementItemsTable Test Case
 */
class StockMovementItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StockMovementItemsTable
     */
    public $StockMovementItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stock_movement_items',
        'app.items',
        'app.stock_movements',
        'app.units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StockMovementItems') ? [] : ['className' => StockMovementItemsTable::class];
        $this->StockMovementItems = TableRegistry::getTableLocator()->get('StockMovementItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StockMovementItems);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
