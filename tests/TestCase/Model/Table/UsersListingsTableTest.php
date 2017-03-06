<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersListingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersListingsTable Test Case
 */
class UsersListingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersListingsTable
     */
    public $UsersListings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_listings',
        'app.users',
        'app.listings',
        'app.ratings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersListings') ? [] : ['className' => 'App\Model\Table\UsersListingsTable'];
        $this->UsersListings = TableRegistry::get('UsersListings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersListings);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
