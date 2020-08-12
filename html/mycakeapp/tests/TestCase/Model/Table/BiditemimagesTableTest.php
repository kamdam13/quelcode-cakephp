<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BiditemimagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BiditemimagesTable Test Case
 */
class BiditemimagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BiditemimagesTable
     */
    public $Biditemimages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Biditemimages',
        'app.Biditems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Biditemimages') ? [] : ['className' => BiditemimagesTable::class];
        $this->Biditemimages = TableRegistry::getTableLocator()->get('Biditemimages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Biditemimages);

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
