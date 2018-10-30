<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemGroupsTable Test Case
 */
class ItemGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemGroupsTable
     */
    public $ItemGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_groups',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemGroups') ? [] : ['className' => ItemGroupsTable::class];
        $this->ItemGroups = TableRegistry::getTableLocator()->get('ItemGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemGroups);

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
}
