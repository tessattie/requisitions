<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuthorizationsRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuthorizationsRolesTable Test Case
 */
class AuthorizationsRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AuthorizationsRolesTable
     */
    protected $AuthorizationsRoles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AuthorizationsRoles',
        'app.Authorizations',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AuthorizationsRoles') ? [] : ['className' => AuthorizationsRolesTable::class];
        $this->AuthorizationsRoles = $this->getTableLocator()->get('AuthorizationsRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AuthorizationsRoles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AuthorizationsRolesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AuthorizationsRolesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
