<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisitionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisitionsTable Test Case
 */
class RequisitionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisitionsTable
     */
    protected $Requisitions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Requisitions',
        'app.Categories',
        'app.Documents',
        'app.Notes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Requisitions') ? [] : ['className' => RequisitionsTable::class];
        $this->Requisitions = $this->getTableLocator()->get('Requisitions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Requisitions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RequisitionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RequisitionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
