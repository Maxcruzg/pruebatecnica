<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserCoursesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserCoursesTable Test Case
 */
class UserCoursesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserCoursesTable
     */
    public $UserCourses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserCourses',
        'app.Users',
        'app.Courses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserCourses') ? [] : ['className' => UserCoursesTable::class];
        $this->UserCourses = TableRegistry::getTableLocator()->get('UserCourses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserCourses);

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
